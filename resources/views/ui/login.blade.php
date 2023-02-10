<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mal-Gari</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome/css/all.min.css') }}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/select2/css/select2.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/style.css') }}">

    <style>
        .bgimage{
            background-image: url('admin-assets/img/bg.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            background-size: cover;            
        }
        .bg-dark {
            background-color: #203b3886!important;
        }
        .bg-dark2 {
            background-color: #2b3742b5!important;
        }
        
    </style>
</head>

<body class="">
    <div class="position-relative col-md-6 mx-auto">
        <div style="filter: blur(2px);" class="position-absolute top-0 start-50">
            <img class="img-fluid" src="admin-assets/img/leaf.png" alt="">
        </div>
    </div>

    <div class="main-wrapper login-body bgimage">
        <div class="login-wrapper bg-dark2">
            
            <div class="container">
                {{-- <img class="img-fluid logo-dark mb-2" src="{{ asset('images/settings/logo.png') }}" alt="Logo"> --}}
                <div class="loginbox bg-dark text-white ">
                    
                    <div class="login-right">
                        <div class="login-right-wrap pass-group">
                            <h1 class="text-white"> <i class="fa fa-user text-info "></i> User Login</h1>
                            <hr>
                            @if (session()->has('error'))
                                <div class="bg-danger alert alert-dismissible fade show" role="alert">
                                    <h6 class="text-center text-white"><strong>{{ session()->get('error') }}</strong>
                                    </h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="login" method="post">
                                
                                @csrf
                                <div class="form-group pass-group">
                                    <label class="form-control-label">Email Address</label>
                                    <input name="email" type="email" class="form-control bg-dark opacity-50 text-white" required>
                                    
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Password</label>
                                    <div class="pass-group">
                                        <input name="password" type="password" class="form-control pass-input bg-dark opacity-50 text-white" required>
                                        <span class="fas fa-eye toggle-password"></span>
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cb1">
                                                <label class="custom-control-label" for="cb1">Remember me</label>
                                            </div>
                                        </div>
                                        <div class="col-6 text-end">
                                            <a class="forgot-link" href="#">Forgot Password ?</a>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-lg btn-block btn-primary w-100" type="submit">Login</button>
                                <div class="login-or">
                                    <span class="or-line"></span>
                                </div>
                                <div class="text-center dont-have text-white">Don't have an account yet? <a class="text-warning"
                                        href="#">Register here</a></div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('admin-assets/js/bootstrap.min.js') }}"></script>
</body>

</html>
