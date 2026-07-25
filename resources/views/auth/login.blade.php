<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login - Hotel 404 Not Found</title>

    <!-- Google Fonts & Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

    <!-- Bootstrap 4.6 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #090d16;
            background-image: 
                radial-gradient(circle at 15% 20%, rgba(99, 102, 241, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 85% 80%, rgba(139, 92, 246, 0.12) 0%, transparent 40%),
                radial-gradient(circle at 50% 50%, rgba(14, 165, 233, 0.08) 0%, transparent 60%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
            color: #f8fafc;
        }

        .login-wrapper {
            width: 100%;
            max-width: 1000px;
            margin: auto;
        }

        .main-card {
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 28px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5), 0 0 40px rgba(99, 102, 241, 0.1);
            overflow: hidden;
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        .hero-section {
            background: linear-gradient(rgba(15, 23, 42, 0.65), rgba(15, 23, 42, 0.85)), 
                        url('https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1000&q=80');
            background-size: cover;
            background-position: center;
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            min-height: 520px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 8px 16px;
            border-radius: 99px;
            font-size: 0.825rem;
            font-weight: 600;
            color: #ffffff;
            width: fit-content;
        }

        .hero-badge .pulse-dot {
            width: 8px;
            height: 8px;
            background-color: #10b981;
            border-radius: 50%;
            box-shadow: 0 0 10px #10b981;
        }

        .hero-content h2 {
            font-size: 2rem;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.25;
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }

        .hero-content p {
            color: #94a3b8;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 0;
        }

        .hero-stats {
            display: flex;
            gap: 20px;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .stat-item h4 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #ffffff;
            margin: 0;
        }

        .stat-item span {
            font-size: 0.75rem;
            color: #94a3b8;
        }

        .form-section {
            padding: 3.5rem 3rem;
            background: #ffffff;
            color: #0f172a;
        }

        .brand-header {
            margin-bottom: 2rem;
        }

        .brand-logo-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 1.4rem;
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
            margin-bottom: 1rem;
        }

        .brand-title {
            font-size: 1.6rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.5px;
            margin-bottom: 4px;
        }

        .brand-subtitle {
            font-size: 0.875rem;
            color: #64748b;
            margin-bottom: 0;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 1.25rem;
        }

        .input-group-custom label {
            font-size: 0.8rem;
            font-weight: 700;
            color: #334155;
            margin-bottom: 6px;
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-field-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1rem;
            transition: color 0.2s ease;
        }

        .form-control-custom {
            width: 100%;
            height: 50px;
            padding: 12px 16px 12px 48px;
            background-color: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 14px;
            font-size: 0.95rem;
            color: #0f172a;
            font-weight: 500;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-control-custom:focus {
            outline: none;
            background-color: #ffffff;
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.12);
        }

        .form-control-custom:focus + .input-icon {
            color: #6366f1;
        }

        .btn-toggle-pwd {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 6px;
            font-size: 1rem;
            transition: color 0.2s ease;
        }

        .btn-toggle-pwd:hover {
            color: #475569;
        }

        .remember-flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.75rem;
        }

        .custom-checkbox-container {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            user-select: none;
            font-size: 0.85rem;
            color: #64748b;
            font-weight: 500;
        }

        .custom-checkbox-container input {
            width: 18px;
            height: 18px;
            accent-color: #6366f1;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-submit-custom {
            width: 100%;
            height: 52px;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #ffffff;
            border: none;
            border-radius: 14px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px -5px rgba(15, 23, 42, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-submit-custom:hover {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            transform: translateY(-2px);
            box-shadow: 0 14px 28px -6px rgba(79, 70, 229, 0.4);
            color: #ffffff;
        }

        .btn-submit-custom:active {
            transform: translateY(0);
        }

        .credentials-hint-card {
            padding: 14px 18px;
            background: #f8fafc;
            border: 1.5px dashed #cbd5e1;
            border-radius: 16px;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .credentials-hint-card:hover {
            background: #f1f5f9;
            border-color: #6366f1;
            transform: translateY(-2px);
            box-shadow: 0 8px 16px -4px rgba(99, 102, 241, 0.12);
        }

        .footer-security {
            margin-top: 1.75rem;
            padding-top: 1rem;
            border-top: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 0.775rem;
            color: #94a3b8;
        }

        @media (max-width: 991px) {
            .form-section {
                padding: 2.5rem 1.75rem;
            }
        }
    </style>
</head>

<body>

    <div class="login-wrapper animate__animated animate__fadeIn">
        <div class="card main-card">
            <div class="card-body p-0">
                <div class="row no-gutters">
                    
                    <!-- Left Hero Section -->
                    <div class="col-lg-6 d-none d-lg-block">
                        <div class="hero-section">
                            <div class="hero-badge">
                                <span class="pulse-dot"></span>
                                Sistem Aktif Online
                            </div>

                            <div class="hero-content">
                                <h2>Kelola Hotel Lebih Mudah & Modern</h2>
                                <p>Sistem terintegrasi untuk pengelolaan kamar, penyewa, dan laporan transaksi realtime secara efisien.</p>

                                <div class="hero-stats">
                                    <div class="stat-item">
                                        <h4>100%</h4>
                                        <span>Terorganisir</span>
                                    </div>
                                    <div class="stat-item">
                                        <h4>24/7</h4>
                                        <span>Akses Layanan</span>
                                    </div>
                                    <div class="stat-item">
                                        <h4>Aman</h4>
                                        <span>Enkripsi Sistem</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Form Section -->
                    <div class="col-lg-6">
                        <div class="form-section">
                            
                            <div class="brand-header">
                                <div class="brand-logo-icon">
                                    <i class="fa-solid fa-hotel"></i>
                                </div>
                                <h1 class="brand-title">Hotel 404 Not Found</h1>
                                <p class="brand-subtitle">Silakan masuk menggunakan akun rahasia Anda.</p>
                            </div>

                            <form action="{{ url('/login') }}" method="POST">
                                @csrf
                                
                                @if ($errors->any())
                                    <div class="alert alert-danger mb-4" style="border-radius: 12px; font-size: 0.85rem; background-color: #fef2f2; border: 1px solid #fecaca; color: #991b1b;">
                                        <div class="d-flex align-items-center mb-1">
                                            <i class="fa-solid fa-triangle-exclamation mr-2"></i>
                                            <strong>Akses Ditolak</strong>
                                        </div>
                                        <ul class="mb-0 pl-3">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Email / Username Input -->
                                <div class="input-group-custom">
                                    <label for="inputEmail">Email / Username</label>
                                    <div class="input-field-wrapper">
                                        <input type="text" name="email" class="form-control-custom"
                                            id="inputEmail" placeholder="Ketik Email / Username" value="{{ old('email') }}" required autofocus autocomplete="off">
                                        <i class="fa-regular fa-user input-icon"></i>
                                    </div>
                                </div>

                                <!-- Password Input -->
                                <div class="input-group-custom">
                                    <label for="inputPassword">Password</label>
                                    <div class="input-field-wrapper">
                                        <input type="password" name="password" class="form-control-custom"
                                            id="inputPassword" placeholder="Ketik Password Rahasia" required autocomplete="current-password">
                                        <i class="fa-solid fa-lock input-icon"></i>
                                        <button type="button" class="btn-toggle-pwd" id="togglePassword">
                                            <i class="fa-regular fa-eye" id="eyeIcon"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Remember Me -->
                                <div class="remember-flex">
                                    <label class="custom-checkbox-container">
                                        <input type="checkbox" name="remember" id="customCheck">
                                        <span>Ingat saya di perangkat ini</span>
                                    </label>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn-submit-custom">
                                    <span>Masuk ke Dashboard</span>
                                    <i class="fa-solid fa-arrow-right"></i>
                                </button>
                            </form>

                            <!-- Credentials Hint Box -->
                            <div class="credentials-hint-card mt-4" id="autoFillBtn">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="d-flex align-items-center">
                                        <i class="fa-solid fa-key mr-2" style="color: #6366f1;"></i>
                                        <strong style="font-size: 0.825rem; color: #1e293b;">Akun Default (Klik untuk Isi Otomatis):</strong>
                                    </div>
                                    <span style="font-size: 0.7rem; font-weight: 700; background: #e0e7ff; color: #4338ca; padding: 4px 10px; border-radius: 20px;">Auto-Fill <i class="fa-solid fa-wand-magic-sparkles ml-1"></i></span>
                                </div>
                                <div style="font-size: 0.8rem; color: #64748b; line-height: 1.6; padding-left: 22px;">
                                    Email / Username: <strong style="color: #0f172a;">admin</strong> <span class="text-muted">(atau adminhotel)</span><br>
                                    Password: <strong style="color: #0f172a;">admin</strong> <span class="text-muted">(atau Hotel404#2026)</span>
                                </div>
                            </div>

                            <div class="footer-security">
                                <i class="fa-solid fa-shield-halved"></i>
                                <span>Koneksi Terenkripsi & Aman</span>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#togglePassword').on('click', function() {
                const pwdField = $('#inputPassword');
                const icon = $('#eyeIcon');
                
                if (pwdField.attr('type') === 'password') {
                    pwdField.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    pwdField.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });

            // Auto-fill interaction when clicking credential card
            $('#autoFillBtn').on('click', function() {
                $('#inputEmail').val('admin');
                $('#inputPassword').val('admin');
                $(this).css('border-color', '#10b981').css('background', '#f0fdf4');
                setTimeout(function() {
                    $('#autoFillBtn').css('border-color', '#cbd5e1').css('background', '#f8fafc');
                }, 1000);
            });
        });
    </script>
</body>
</html>
