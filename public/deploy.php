<?php
// Set execution time to unlimited since zipping and uploading might take a minute
ini_set('max_execution_time', 600);
ini_set('memory_limit', '512M');

echo "<h3>Laravel Automatic Deployer to InfinityFree (using Phar TAR)</h3>";
flush();

// Clean up any old project.tar in public directory if it exists
$oldTarFile = __DIR__ . '/project.tar';
if (file_exists($oldTarFile)) {
    @chmod($oldTarFile, 0777);
    @unlink($oldTarFile);
}

// 1. Export local database
echo "Exporting local database... ";
flush();
try {
    // Read local env
    $envContentLocal = file_get_contents(__DIR__ . '/../.env');
    preg_match('/DB_DATABASE=(.*)/', $envContentLocal, $matchesDb);
    preg_match('/DB_USERNAME=(.*)/', $envContentLocal, $matchesUser);
    preg_match('/DB_PASSWORD=(.*)/', $envContentLocal, $matchesPass);
    preg_match('/DB_HOST=(.*)/', $envContentLocal, $matchesHost);

    $dbName = trim($matchesDb[1] ?? 'laravel');
    $dbUser = trim($matchesUser[1] ?? 'root');
    $dbPass = trim($matchesPass[1] ?? '');
    $dbHost = trim($matchesHost[1] ?? '127.0.0.1');

    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $tables = [];
    $result = $pdo->query("SHOW TABLES");
    while ($row = $result->fetch(PDO::FETCH_NUM)) {
        $tables[] = $row[0];
    }

    $sql = "";
    foreach ($tables as $table) {
        $result = $pdo->query("SHOW CREATE TABLE `$table`");
        $showCreate = $result->fetch(PDO::FETCH_ASSOC);
        $sql .= "DROP TABLE IF EXISTS `$table`;\n" . $showCreate['Create Table'] . ";\n\n";

        $result = $pdo->query("SELECT * FROM `$table`");
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $keys = array_map(function($k) { return "`$k`"; }, array_keys($row));
            $values = array_map(function($v) use ($pdo) {
                if ($v === null) return "NULL";
                return $pdo->quote($v);
            }, array_values($row));
            $sql .= "INSERT INTO `$table` (" . implode(', ', $keys) . ") VALUES (" . implode(', ', $values) . ");\n";
        }
        $sql .= "\n\n";
    }
    file_put_contents(__DIR__ . '/database.sql', $sql);
    echo "<span style='color:green;'>OK</span><br>";
} catch (Exception $e) {
    echo "<span style='color:red;'>FAILED: " . $e->getMessage() . "</span><br>";
    exit;
}
flush();

// 2. Create project TAR (excluding node_modules, .git, etc.)
echo "Creating project TAR archive in temp folder... ";
flush();

// Create TAR in the system temp directory so it doesn't self-reference
$tarFile = sys_get_temp_dir() . '/laravel_project.tar';
if (file_exists($tarFile)) {
    @unlink($tarFile);
}

try {
    $tar = new PharData($tarFile);
    
    $sourceDir = realpath(__DIR__ . '/../');
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($sourceDir, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($files as $name => $file) {
        if (!$file->isDir()) {
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($sourceDir) + 1);
            $relativePath = str_replace('\\', '/', $relativePath);

            // Exclusions
            if (
                strpos($relativePath, 'node_modules/') === 0 ||
                strpos($relativePath, '.git/') === 0 ||
                strpos($relativePath, 'storage/logs/') === 0 ||
                strpos($relativePath, 'storage/framework/cache/') === 0 ||
                strpos($relativePath, 'storage/framework/sessions/') === 0 ||
                strpos($relativePath, 'storage/framework/views/') === 0 ||
                $relativePath === 'public/project.tar' ||
                $relativePath === 'public/database.sql' ||
                $relativePath === 'public/deploy.php' ||
                $relativePath === 'public/extract.php'
            ) {
                continue;
            }

            $tar->addFile($filePath, $relativePath);
        }
    }
    echo "<span style='color:green;'>OK (" . number_format(filesize($tarFile) / 1024 / 1024, 2) . " MB)</span><br>";
} catch (Exception $e) {
    echo "<span style='color:red;'>FAILED: " . $e->getMessage() . "</span><br>";
    exit;
}
flush();

// 3. FTP upload
echo "Connecting to FTP server (ftpupload.net)... ";
flush();

$ftpHost = 'ftpupload.net';
$ftpUser = 'if0_42492891';
$ftpPass = 'QsAAfeOpvrSe7';

$conn = ftp_connect($ftpHost);
if (!$conn) {
    echo "<span style='color:red;'>FAILED to connect to FTP host</span><br>";
    exit;
}

if (!ftp_login($conn, $ftpUser, $ftpPass)) {
    echo "<span style='color:red;'>FAILED to login to FTP</span><br>";
    exit;
}

ftp_pasv($conn, true);
echo "<span style='color:green;'>Connected</span><br>";
flush();

echo "Uploading files...<br>";
flush();

// Upload extract.php helper
$extractCode = <<<'EOD'
<?php
header('Content-Type: text/plain');
ini_set('max_execution_time', 600);
ini_set('memory_limit', '512M');

echo "Remote extraction started...\n";

// 1. Extract project.tar to root folder
if (file_exists('project.tar')) {
    echo "Extracting project.tar... ";
    try {
        $phar = new PharData('project.tar');
        $phar->extractTo('../', null, true); // overwrite existing files
        echo "OK\n";
    } catch (Exception $e) {
        echo "FAILED to extract: " . $e->getMessage() . "\n";
        exit;
    }
} else {
    echo "FAILED: project.tar not found\n";
    exit;
}

// 2. Copy public directory contents to htdocs
echo "Copying public assets to htdocs... ";
function copyFolder($src, $dst) {
    $dir = opendir($src);
    @mkdir($dst);
    while (false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
            if (is_dir($src . '/' . $file)) {
                copyFolder($src . '/' . $file, $dst . '/' . $file);
            } else {
                copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}
if (is_dir('../public')) {
    copyFolder('../public', './');
    echo "OK\n";
} else {
    echo "FAILED: public directory not found\n";
}

// 3. Configure production .env
echo "Configuring .env file... ";
$envConfig = "APP_NAME=\"Hotel 404 Not Found\"\n"
           . "APP_ENV=production\n"
           . "APP_KEY=base64:7m5DqC3x7Vf1Xn4Vj8V1Q9B8P7R6d5e4F3g2h1j0k=\n"
           . "APP_DEBUG=false\n"
           . "APP_URL=http://hotel404notfound.great-site.net\n\n"
           . "DB_CONNECTION=mysql\n"
           . "DB_HOST=sql101.infinityfree.com\n"
           . "DB_PORT=3306\n"
           . "DB_DATABASE=if0_42492891_hotel\n"
           . "DB_USERNAME=if0_42492891\n"
           . "DB_PASSWORD=QsAAfeOpvrSe7\n\n"
           . "SESSION_DRIVER=file\n"
           . "QUEUE_CONNECTION=sync\n";
file_put_contents('../.env', $envConfig);
echo "OK\n";

// 4. Import database
if (file_exists('database.sql')) {
    echo "Importing database... ";
    try {
        $pdo = new PDO("mysql:host=sql101.infinityfree.com;dbname=if0_42492891_hotel;charset=utf8", "if0_42492891", "QsAAfeOpvrSe7");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sqlContent = file_get_contents('database.sql');
        $pdo->exec($sqlContent);
        echo "OK\n";
    } catch (Exception $e) {
        echo "FAILED: " . $e->getMessage() . "\n";
    }
}

// 5. Cleanup
echo "Cleaning up temporary files... ";
@unlink('project.tar');
@unlink('database.sql');
echo "OK\n";
echo "DEPLOYMENT COMPLETE! You can now visit http://hotel404notfound.great-site.net\n";
EOD;

file_put_contents(__DIR__ . '/extract.php', $extractCode);

echo "Uploading project.tar (this might take a few moments)... ";
flush();
if (ftp_put($conn, '/htdocs/project.tar', $tarFile, FTP_BINARY)) {
    echo "<span style='color:green;'>OK</span><br>";
} else {
    echo "<span style='color:red;'>FAILED</span><br>";
    exit;
}
flush();

echo "Uploading database.sql... ";
flush();
if (ftp_put($conn, '/htdocs/database.sql', __DIR__ . '/database.sql', FTP_BINARY)) {
    echo "<span style='color:green;'>OK</span><br>";
} else {
    echo "<span style='color:red;'>FAILED</span><br>";
}
flush();

echo "Uploading extract.php... ";
flush();
if (ftp_put($conn, '/htdocs/extract.php', __DIR__ . '/extract.php', FTP_BINARY)) {
    echo "<span style='color:green;'>OK</span><br>";
} else {
    echo "<span style='color:red;'>FAILED</span><br>";
}
flush();

ftp_close($conn);

// Cleanup local temp files
@unlink($tarFile);
@unlink(__DIR__ . '/database.sql');
@unlink(__DIR__ . '/extract.php');

echo "<br><b>Triggering remote extraction...</b><br>";
flush();

// Hit remote extract.php to start extraction on the server
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://hotel404notfound.great-site.net/extract.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 300); // 5 minutes timeout
$response = curl_exec($ch);
curl_close($ch);

echo "<pre>" . htmlspecialchars($response) . "</pre>";
echo "<br><b>All steps completed successfully!</b>";
?>
