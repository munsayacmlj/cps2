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
								<label for="usernameLoginInput">Username</label>
								<input type="text" class="form-control" name="username" id="usernameLoginInput" autocomplete="new-password" required>
								<small id="chkUsr" class="form-text text-muted"></small>
							</div>
							<div class="form-group">
								<label for="loginPassword">Password</label>
								<input type="password" class="form-control" id="loginPassword" name="password" autocomplete="new-password" required>
							</div>
							<div class="form-check">
								<input type="checkbox" class="form-check-input" id="rememberMe">
								<label class="form-check-label" for="rememberMe">Remember Me</label>
							</div>
							<button type="submit" name="login" class="btn btn-black" id="logSubmitBtn">Sign in</button>
							
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
	<script src="assets/js/jquery.cookie.js"></script>
	<script>
		/*COOKIE LOGIN*/
		$('#loginForm').on('submit', function() {

			if ($('#rememberMe').is(':checked')) {
				var username = $('#usernameLoginInput').val();
				var password = $('#loginPassword').val();

				$.cookie('username', username, { expires: 7 });
				$.cookie('password', password, { expires: 7 });
				$.cookie('remember', true, { expires: 7});
			}
			else {
				$.cookie('username', "");
				$.cookie('password', "");
				$.cookie('remember', null);
			}
		});

		var remember = $.cookie('remember');
		if (remember == 'true') {
			var username = $.cookie('username');
			var password = $.cookie('password');
			$('#usernameLoginInput').val(username);
			$('#loginPassword').val(password);
			$('#rememberMe').prop('checked', true);
		}
		/* END COOKIE LOGIN */
	</script>
</body>
</html>