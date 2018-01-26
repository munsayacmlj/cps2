<?php 
	session_start();
 ?>

<div class="header-top">
	
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-5">
				<ul class="list-inline text-muted d-none d-sm-none d-md-block">
					<li>
						<strong>Call Us:</strong>
						<a class="contact-num" href="#">+63 999 322 2322</a>
					</li>
				</ul>
			</div>

			<div class="col-12 col-md-7">
				<div id="header-top-right" class="text-right">
					<ul class="list-inline">
						<li class="list-inline-item d-md-none d-lg-none d-xl-none">
							<strong>Call Us:</strong>
							<a class="contact-num" href="#">+63 999 322 2322</a>
						</li>

						<?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin') :	?>			
						
							<li class="list-inline-item">
						 		<a href="admin_page.php?admin=<?php echo $_SESSION['username'] ?>" class="admin-page"><span class="welcome-user">Welcome, <?php echo "Admin"; ?>!</span></a>
							 	</li>
								<li class="list-inline-item">
								<i class="fa fa-sign-in pl-2 pr-1"></i>
								<a class="link-dark" href="logout.php">Logout</a>
							</li>
						<?php
							elseif (isset($_SESSION['username'])) :
								require "connection.php";
								$username = $_SESSION['username'];
								$sql = "SELECT first_name, last_name FROM users WHERE username = '$username'";
								$result = mysqli_query($connection, $sql);
								$row = mysqli_fetch_assoc($result);
								extract($row);
						 ?>
						 	<li class="list-inline-item">
						 		<span class="welcome-user">Welcome, <?php echo $first_name . " " . $last_name; ?>!</span>
						 	</li>
							<li class="list-inline-item">
								<i class="fa fa-sign-in pl-2 pr-1"></i>
								<a class="link-dark" href="logout.php">Logout</a>
							</li>
						<?php 
							else :
						 ?>
							 <li class="list-inline-item">
								<i class="fa fa-sign-in pl-2 pr-1"></i>
								<a class="link-dark" href="login.php">Login</a>
							</li>
							<li class="list-inline-item">
								<i class="fa fa-user-plus pl-2 pr-1"></i>
								<a class="link-dark" href="register.php">Sign up</a>
							</li>
						<?php endif; ?>
					</ul>
				</div>

			</div>
		</div>
	</div>
</div>