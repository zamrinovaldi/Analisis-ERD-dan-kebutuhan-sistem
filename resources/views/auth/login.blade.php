<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login - Hotel 404 Not Found</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .container {
            max-width: 950px;
        }
        .login-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            background: #ffffff;
        }
        .bg-login-image-custom {
            background: url('https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?auto=format&fit=crop&w=600&q=80');
            background-size: cover;
            background-position: center;
            position: relative;
        }
        .bg-login-image-custom::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(30, 41, 59, 0.15);
        }
        .login-title {
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.5px;
            margin-bottom: 8px;
            font-size: 1.35rem;
            white-space: nowrap;
        }
        .login-subtitle {
            color: #64748b;
            font-size: 0.85rem;
            margin-bottom: 1.75rem;
        }
        .form-control-modern {
            border-radius: 12px;
            height: 46px;
            padding: 10px 16px;
            border: 1px solid #e2e8f0;
            font-size: 0.9rem;
            color: #334155;
            transition: all 0.2s ease;
        }
        .form-control-modern:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            color: #0f172a;
        }
        .btn-modern {
            background: #0f172a;
            color: #ffffff;
            border: none;
            border-radius: 12px;
            height: 46px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            box-shadow: 0 4px 6px -1px rgba(15, 23, 42, 0.1), 0 2px 4px -1px rgba(15, 23, 42, 0.06);
        }
        .btn-modern:hover {
            background: #1e293b;
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(15, 23, 42, 0.15), 0 4px 6px -2px rgba(15, 23, 42, 0.05);
        }
        .btn-modern:active {
            transform: translateY(0);
        }
        .custom-control-label-modern {
            font-size: 0.85rem;
            color: #64748b;
            user-select: none;
            cursor: pointer;
            padding-top: 2px;
        }
        .divider {
            border-top: 1px solid #f1f5f9;
            margin: 1.25rem 0;
        }
        .default-credentials {
            background-color: #f8fafc;
            border-radius: 12px;
            padding: 12px 16px;
            border: 1px dashed #e2e8f0;
        }
        .default-credentials strong {
            color: #0f172a;
        }
    </style>
</head>

<body>

    <div class="container animate__animated animate__fadeIn">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card login-card">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- Left Column (Visual Card Info) -->
                            <div class="col-lg-6 d-none d-lg-block bg-login-image-custom">
                            </div>
                            <div class="col-lg-6">
                                <div style="padding: 2.5rem 2.25rem;">
                                    <div>
                                        <h1 class="h4 login-title d-flex align-items-center">
                                            <i class="fas fa-hotel mr-2" style="color: #4f46e5;"></i>Hotel 404 Not Found
                                        </h1>
                                        <p class="login-subtitle">Silakan masuk untuk mengelola sistem.</p>
                                    </div>
                                    <form action="{{ url('/login') }}" method="POST">
                                        @csrf
                                        
                                        @if ($errors->any())
                                            <div class="alert alert-danger" style="border-radius: 12px; font-size: 0.85rem;">
                                                <ul class="mb-0 pl-3">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <label for="exampleInputEmail" style="font-size: 0.8rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Email / Username</label>
                                            <input type="text" name="email" class="form-control form-control-modern"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="admin@admin.com" value="{{ old('email', 'admin@admin.com') }}" required autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword" style="font-size: 0.8rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Password</label>
                                            <div class="position-relative">
                                                <input type="password" name="password" class="form-control form-control-modern pr-5"
                                                    id="exampleInputPassword" placeholder="Password Anda" value="admin" required>
                                                <div class="position-absolute" style="top: 50%; right: 16px; transform: translateY(-50%); cursor: pointer; z-index: 10;" id="togglePassword">
                                                    <i class="fas fa-eye text-gray-400"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-4">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="remember" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label custom-control-label-modern" for="customCheck">Ingat saya di perangkat ini</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-modern btn-block">
                                            Masuk
                                        </button>
                                    </form>
                                    <div class="divider"></div>
                                    <div class="default-credentials text-xs text-muted">
                                        <div class="d-flex align-items-center mb-1">
                                            <i class="fas fa-info-circle mr-2" style="color: #4f46e5;"></i>
                                            <span style="font-weight: 600; color: #475569; font-size: 0.8rem;">Gunakan akun default:</span>
                                        </div>
                                        <div style="font-size: 0.75rem; color: #64748b; line-height: 1.5; padding-left: 20px;">
                                            Email / Username: <strong>admin@admin.com</strong> atau <strong>admin</strong><br>
                                            Password: <strong>admin</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#togglePassword').on('click', function() {
                const passwordField = $('#exampleInputPassword');
                const passwordFieldType = passwordField.attr('type');
                const icon = $(this).find('i');
                
                if (passwordFieldType === 'password') {
                    passwordField.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordField.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
        });
    </script>
</body>
</html>
