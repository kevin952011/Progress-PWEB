<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600,700,800" rel="stylesheet">

	<title>Login Page!</title>

	<style type="text/css">
		body {
			font-family: 'Work Sans';
			color: rgba(30, 33, 33, 1.0);
		}

		#main-container {
			position: absolute;
			top: 0;
			left: 0;

			width: 100%;
			height: 100vh;
			background: url('dum-img/bg1.jpg') no-repeat center rgba(0, 0, 0, .4);
			background-size: cover;
			background-blend-mode: darken;

			display: flex;
			flex-flow: column;
			justify-content: center;
			align-items: center;
		}
		#login-form {
			width: 350px;
			height: 270px;
			background-color: rgba(241, 246, 249, .5);

			border-radius: 10px;
		}
		#header {
			width: 100%;
			height: 30%;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		#form {
			width: 100%;
			height: 70%;

			display: flex;
			flex-flow: column;
			justify-content: center;
			align-items: center;
		}
		#form input {
			margin: 5px;
			border: none;
			border-radius: 2px;

			height: 25px;
			font-size: 16;
		}
		#form button {
			margin: 20px 5px 5px 5px;
			width: 70px;
			height: 25px;
			border-radius: 5px;
			background-color: rgba(30, 33, 33, 1.0);

			border: none;
			color: white;
			font-weight: 700;
			cursor: pointer;
		}
		#register {
			color: white;
			display: flex;
			flex-flow: row;

			align-items: flex-end;

			margin-top: 10px;
		}
		#register p {
			color: white;
			margin: 0px;
		}
		#register h3 {
			color: white;
			opacity: .9;
			margin: 0px;
			font-weight: 600;

			cursor: pointer;
		}
	</style>
</head>
<body>
	<div id="main-container">
		<div id="login-form">
			<div id="header">
				<h1>Register!</h1>
			</div>
			<form id="form">
				<input type="text" name="" placeholder="Username">
				<input type="password" name="" placeholder="Passoword">
				<input type="password" name="" placeholder="Re-confirm Password">
				<span>
					<button>Register</button>
					<button onclick="cancel_login()">Cancel</button>
				</span>
			</form>
		</div>
		<div id="register">
			<br>
			<p>Already have an account?&nbsp;</p>
			<a href="login.php"><h3>Login here!</h3></a>
		</div>
	</div>

	<script type="text/javascript">
		function cancel_login() {
			window.open('index.php');
		}
	</script>
</body>
</html>