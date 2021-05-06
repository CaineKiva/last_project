<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="{{ asset('public/css/logincss.css') }}">
	<link rel="stylesheet" href="https://yourwebsite.com/style.css">
	<link rel="stylesheet" href="https://codepen.io/username/pen/aBcDef">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://codepen.io/username/pen/aBcDef"></script>
	<script>
	$("#login-button").click(function(event){
			 event.preventDefault();

		 $('form').fadeOut(500);
		 $('.wrapper').addClass('form-success');
	});
	</script>

</head>
<body>
	<div class="wrapper">
	<div class="container">
		<h1>Welcome</h1>

		<form class="form">
			<div>
				<a href="{{ route('login_admin') }} " class="select_login">Sign in Admin</a>
				<a href="{{ route('login_doctor') }}" class="select_login">Sign in Doctor</a>
                <!-- {{-- <a href="{{ route('login_student') }}" class="select_login">Sign in Student</a> --}} -->
			</div>


		</form>
	</div>

	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>
</body>
</html>