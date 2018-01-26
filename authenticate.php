<?php 
	
	require "connection.php";
	session_start();

	if (isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = sha1($_POST['password']);

		$sql = "SELECT *, c.status as user_status FROM users a JOIN roles b ON (a.role_id = b.id) JOIN user_status c ON (a.status_id = c.id)
				 WHERE a.username = '$username' AND a.password = '$password'";
		$result = mysqli_query($connection, $sql);

		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			extract($row);

			if ($user_status == 'ok') {
				$_SESSION['username'] = $username;
				$_SESSION['role'] = $row['role_name'];
				
				$username_query = $_SESSION['username'];

				$sql = "SELECT id FROM orders WHERE user_id = 
						(SELECT id FROM users WHERE username = '$username_query') AND status = 'pending'";
				$result = mysqli_query($connection, $sql);
				$row = mysqli_fetch_assoc($result);
				extract($row);
				if (mysqli_num_rows($result) > 0){
					$sql = "SELECT * FROM order_details WHERE order_id = '$id'";
					$result = mysqli_query($connection, $sql);
					while($row = mysqli_fetch_assoc($result)){
						extract($row);
						// echo $product_id . "<br>";
						if(isset($_SESSION['cart'][$product_id])){
								$_SESSION['cart'][$product_id] += 1;
						}
						else{
							$_SESSION['cart'][$product_id] = 1;
						}
					}
				}
				header('location: index.php');		
			}
			elseif ($user_status == 'banned'){
				echo "The BAN HAMMER has been executed by the admin";
			}
		}
		else{
			echo "Failed to login. Incorrect login credentials. <br>";
			echo "Login again <a href='login.php' style='color: red'>here</a>";
		}
	}

 ?>