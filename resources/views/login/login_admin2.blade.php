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

		<form class="form" action="{{ route('process_login_admin') }}" method="post">
			@csrf

			<input type="email" name="email" placeholder="Username">
			<input type="password" name="password" placeholder="Password">
			<button type="submit" id="login-button">Login</button>

			<br><br>

				<a href="{{ route('login') }}" class="select_login">Back</a>


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