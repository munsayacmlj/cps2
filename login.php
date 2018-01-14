<!DOCTYPE html>
<html>
<head>
	<title>Online Shopping - Login</title>
	<?php require "assets/partials/head.php"; ?>
</head>
<body>
	<?php //require "assets/partials/top-nav.php" ?>
	<?php //require "assets/partials/navigation.php" ?>

	<div class="login-page">
		
		<div class="logo-home">
			<a href="index.php"><img src="assets/images/gitgud.jpg"></a>
		</div>


		<div class="login-container">
			<div class="container">
				<div class="row">
					<div id="login">
						<div class="sign-in">
							<h1>Sign in</h1>
						</div>
						<form action="authenticate.php" method="POST">
							<div class="form-group">
								<label for="exampleInputEmail1">Username</label>
								<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter username" name="username" id="usernameLoginInput">
								<small id="chkUsr" class="form-text text-muted"></small>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Password</label>
								<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
							</div>
							<div class="form-check">
								<input type="checkbox" class="form-check-input" id="exampleCheck1">
								<label class="form-check-label" for="exampleCheck1">Remember Me</label>
							</div>
							<button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
						</form>
					</div> <!-- /.login -->

		<!-- 	<div class="or-divider col-12 col-md-3 col-lg-3">
				<div class="inner">
					<div class="login_or"><span class="or-text">Or</span></div>
				</div>
			</div>
		-->
				</div> <!-- /.row -->
			</div> <!-- /.container -->

		</div> <!-- /.login-container -->
	</div> <!-- /.login-page -->


<?php //require "assets/partials/footer.php" ?>


</body>
</html>