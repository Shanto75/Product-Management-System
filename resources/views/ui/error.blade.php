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
</head>

<body class="error-page">

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <div class="error-box">
            <h1>404</h1>
            <h3 class="h2 mb-3"><i class="fas fa-exclamation-circle"></i> Oops! Page not found!</h3>
            <p class="h4 font-weight-normal">The page you requested was not found or You have no Permission to Visit the page.</p>
            <a href="{{ url('/'.Auth::user()->type.'/dashbord') }}" class="btn btn-primary"><i class="fa fa-chevron-left"></i> Go To Dashbord</a>
        </div>

    </div>
    <!-- /Main Wrapper -->


    <!-- Bootstrap Core JS -->
    <script src="{{ asset('admin-assets/js/bootstrap.min.js') }}"></script>
</body>

</html>
