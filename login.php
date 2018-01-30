<!DOCTYPE html>
<html>
<head>
	<title>Online Shopping - Login</title>
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
					<div id="login" class="col-xs col-sm col-lg-5">
						<div class="sign-in-text">
							<h1>Sign in</h1>
						</div>
						<form action="authenticate.php" method="POST" id="loginForm">
						
							<div class="form-group">
								<label for="exampleInputEmail1">Username</label>
								<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username" id="usernameLoginInput" autocomplete="new-password" required>
								<small id="chkUsr" class="form-text text-muted"></small>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Password</label>
								<input type="password" class="form-control" id="exampleInputPassword1" name="password" autocomplete="new-password" required>
							</div>
							<button type="submit" name="login" class="btn btn-primary" id="submitBtn">Sign in</button>
							
							<!-- <div class="form-check">
								<input type="checkbox" class="form-check-input" id="exampleCheck1">
								<label class="form-check-label" for="exampleCheck1">Remember Me</label>
							</div> -->
						</form>
						
						<div class="reg-page-button">
						    <div class="new-customer-divider">
						        <span class="new-cust-text">New Customer?</span>
						    </div>
						    
						    <div class="new-customer-button">
						        <span id="create-account-button">
                                        <a href="register.php"> 
                                    <span class="ca-inner-button">
                                        	Create your new account
                                    </span>
                                        </a>
						        </span>
						    </div>
						</div> <!-- /.reg-page-button -->
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
	
	<script src="assets/js/main.js"></script>
	<script src="assets/js/alertify.js" type="text/javascript"></script>
</body>
</html>