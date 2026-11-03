<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='shortcut icon' href='gambar/sistem/frauddetection.png'>
    <title>Fraud Detection System| Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('AdminLTE')}}/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{asset('css/theme.css')}}">

    <link rel="stylesheet" href="{{asset('font/css/all.min.css')}}">
</head>

<body class="hold-transition login-page">
    <div class="login-split">
        <section class="login-visual">
            <div class="login-visual-content">
                <img src="{{asset('gambar/sistem/frauddetection.png')}}" alt="Fraud Detection" class="login-visual-logo">
                <p class="login-visual-eyebrow">Intelligent Claim Monitoring</p>
                <h1>Fraud Detection System</h1>
                <p class="login-visual-text">
                    Identify suspicious claim patterns with a centralized, data-driven scoring dashboard.
                </p>
                <ul class="login-visual-features">
                    <li><i class="fas fa-shield-alt"></i><span>Detect suspicious claim patterns</span></li>
                    <li><i class="fas fa-chart-line"></i><span>Centralized risk scoring</span></li>
                    <li><i class="fas fa-search"></i><span>Real-time claim monitoring</span></li>
                </ul>
            </div>
        </section>

        <main class="login-form-panel">
            <div class="login-form-container">

                @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show login-alert" role="alert">
                    {{session('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                @if(session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show login-alert" role="alert">
                    {{session('loginError')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <div class="card login-card">
                    <div class="card-header text-center">
                        <div class="login-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h2 class="login-title">Fraud Detection System</h2>
                        <p class="login-subtitle">Sign in to your account</p>
                    </div>
                    <div class="card-body">
                        <form action="/login" method="post">
                            @csrf

                            <div class="form-group">
                                <div class="input-group login-input-group mb-3">
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email address" autofocus required value="{{old ('email')}}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @endError
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group login-input-group mb-3">
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn password-toggle" onclick="togglePassword()" aria-label="Show password">
                                            <i class="fas fa-eye" id="passwordIcon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block login-button">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- jQuery -->
    <script src="{{asset('AdminLTE')}}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('AdminLTE')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('AdminLTE')}}/dist/js/adminlte.min.js"></script>
</body>

<script>
    function togglePassword() {
        var input = document.getElementById("password");
        var icon = document.getElementById("passwordIcon");

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>

</html>
