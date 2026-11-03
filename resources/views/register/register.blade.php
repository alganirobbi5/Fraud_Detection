<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='shortcut icon' href='gambar/sistem/frauddetection.png'>
    <title>Fraud Detection System| Registration Page</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('AdminLTE')}}/dist/css/adminlte.min.css">
</head>

<style type="text/css">
    body {
    
    background-image:url(gambar/sistem/Insurance_Background.jpg);
    
    background-repeat: no-repeat;
    
    background-attachment: fixed;
    
    background-size: 100% 100%;

    backdrop-filter: blur(2px);
    
    color: black;
    
    }
</style>
<body class="hold-transition register-page">
    <div class="register-box">
        <div class="card">
            <div class="card-body register-card-body">
                <div class="card-header text-center">
                    <b style="font-size:170%;">Fraud Detection System</b>
                </div>
                <h1 class="login-box-msg"><b >Register</b></h1>
                <form action="/register" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control @error('name')is-invalid @enderror" id="name" placeholder="Name" required value="{{old('name')}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control @error('email')is-invalid @enderror" id="email" placeholder="Email" required value="{{old('email')}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control @error('password')is-invalid @enderror" id="password" placeholder="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <!-- /.col -->
            </div>
            </form>
            <p class="mb-30" style="text-align:center;">Already have an account?
                <a href="/login">Please Sign In </a>
            </p>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="{{asset('AdminLTE')}}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('AdminLTE')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('AdminLTE')}}/dist/js/adminlte.min.js"></script>
</body>

</html>