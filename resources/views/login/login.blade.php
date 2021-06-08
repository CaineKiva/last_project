<!-- {{-- @if (Session::has('sussess'))
    <h1>
    	{{ Session::get('sussess') }}
    </h1>
@endif

@if (Session::has('error'))
    <h1>
    	{{ Session::get('error') }}
    </h1>
@endif

<form action="{{ route('process_login') }}" method="post"> 
	@csrf
	
	Email
	<input type="email" name="email" value="">	
	<br>
	password
	<input type="password" name="password" value="">
	<br>
	<button type="submit">login</button>
</form> --}}



<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sufee Admin - HTML5 Admin Template</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

	<link rel="stylesheet" href="{{ asset('public/vendors/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/vendors/themify-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('public/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/vendors/selectFX/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('public/vendors/jqvmap/dist/jqvmap.min.css') }}">


    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <{{-- link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'> --}}



</head>

<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <h1 style="color: white">Login</h1>
                </div>
                <div class="login-form">
                    <form method="post">
                        {{-- <div class="form-group">
                            <label>Email address</label>
                            <input type="email" class="form-control" placeholder="Email" readonly="readonly">
                        </div>
                        <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="Password" readonly="readonly">
                        </div> --}}
                                
                        <div class="register-link m-t-15 text-center">
                            
                            
                        </div>
                                <div class="social-login-content">
                                    <div class="social-button">
                                        {{-- <button type="" class="btn social facebook btn-flat btn-addon mb-3">Sign in Admin</button> --}}
                                        <a href="{{ route('login_admin') }}" class="btn social facebook btn-flat btn-addon mb-3">Sign in Admin</a>
                                        <a href="{{ route('login_doctor') }}" class="btn btn-success btn-flat m-b-30 m-t-30">Sign Teacher</a>
                                        <a href="{{ route('login_nurse') }}" class="btn social twitter btn-flat btn-addon mt-2">Sign in Student</a>
                                        {{-- <button type="" class="btn btn-success btn-flat m-b-30 m-t-30">Sign Teacher</button>
                                        <button type="" class="btn social twitter btn-flat btn-addon mt-2">Sign in Student</button> --}}
                                    </div>
                                </div>
                                
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('public/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('public/vendors/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('public/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/main.js') }}"></script>


</body>

</html> -->
