<!DOCTYPE html>
<html>
<head>
	<title>MLJM Shop - Register</title>
	<?php require "assets/partials/head.php"; ?>
</head>
<body style="margin-bottom: 0">
	<?php //require "assets/partials/top-nav.php" ?>
	<?php //require "assets/partials/navigation.php" ?>

	<div class="login-page">
		
		<div class="logo-home">
			<a href="index.php"><img src="assets/images/bg/tesla-logo.png"></a>
		</div>


		<div class="login-container">
			<div class="container">
				<div class="row">
					<div id="login">
						<div class="sign-in-text">
							<h1>Create account</h1>
						</div>
						<form action="endpoint.php" method="POST">

							<div class="row" id="input-names-reg">
								<div class="form-group col-xs-6 col-md-6">
										<label for="inputFirstName">First Name</label>
										<input type="text" class="form-control" id="inputFirstName" name="firstname" required>
								</div>
								<div class="form-group col-xs-6 col-md-6">
										<label>Last Name</label>
										<input type="text" class="form-control" id="inputLastName" name="lastname" required>
								</div>
							</div>
							

							<div class="form-group">
								<label for="InputUsername">Username</label>
								<input type="text" class="form-control" id="InputUsername" aria-describedby="emailHelp" name="reg-username" autocomplete="new-password" required>
								<span id="chkUsr" class="form-text"></span>
							</div>
							<div class="form-group">
								<label for="InputPassword">Password</label>
								<input type="password" class="form-control" id="InputPassword" name="reg-password" autocomplete="new-password" required>
							</div>
							<div class="registerBtnDiv">
								<button type="submit" name="register" class="btn btn-black" id="regSubmitBtn">Create your MLJM account</button>
							</div>
						</form>
						<div class="a-divider">
							<div class="a-divider-inner">
							</div>
						</div>
						<div class="a-row">
							Already have an account?
							<a href="login.php">Sign in</a>
						</div>
					</div> <!-- /.login -->
				</div> <!-- /.row -->
			</div> <!-- /.container -->

		</div> <!-- /.login-container -->
		
		<div class="login-page-footer">
		    <div class="page-divider-section">
		        &copy; 2018, MLJM.com, Inc or its affiliates
		    </div>
		</div> <!-- /.login-page-footer -->
	</div> <!-- /.login-page -->
</body>
<script src="assets/js/main.js"></script>
</html>