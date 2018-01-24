<?php 
	
	require "connection.php";

	if (isset($_POST['register'])) { /* register account endpoint */
		
		$first_name = $_POST['firstname'];
		$last_name = $_POST['lastname'];
		$username = $_POST['reg-username'];
		$password = sha1($_POST['reg-password']);

		$sql = "INSERT INTO users (first_name, last_name, username, password, role_id)
				VALUES ('$first_name', '$last_name', '$username', '$password', 1)";
		mysqli_query($connection, $sql);

		header('location: login.php');
		exit;
	}

	if (isset($_GET['add_to_cart'])) {
		session_start();
		$get_product_id = $_GET['id']; /* products.id*/


		$now = new DateTime();
		$date = $now->format('Y-m-d H:i:s');
		// echo $now->format('Y-m-d H:i:s');
		$username = $_SESSION['username'];

		$sql = "SELECT id FROM users WHERE username = '$username'";
		$result = mysqli_query($connection, $sql);
		$row = mysqli_fetch_assoc($result);
		extract($row);
		$user_id = $id; /*$id from $row, id of the user*/

		$sql = "SELECT * FROM orders WHERE user_id = $user_id";
		$result = mysqli_query($connection, $sql);
		if(mysqli_num_rows($result) == 0){
			$sql = "INSERT INTO orders (order_date, user_id, status) VALUES ('$date', '$user_id', 'pending')";
			mysqli_query($connection, $sql);
		}


		$sql = "SELECT * FROM products WHERE id = $get_product_id";
		$result = mysqli_query($connection, $sql);
		$row = mysqli_fetch_assoc($result);
		extract($row);
		$extracted_product_id = $id;
		$extracted_price = $price;
		


		$sql = "SELECT id FROM orders WHERE user_id = $user_id";
		$result = mysqli_query($connection, $sql);
		$row = mysqli_fetch_assoc($result);
		extract($row);
		$extracted_order_id = $id;
		

		$sql = "INSERT INTO order_details (quantity, total_price, product_id, order_id)
					VALUES (1, '$extracted_price', '$extracted_product_id', '$extracted_order_id')";
		mysqli_query($connection, $sql);
		
		if (empty($_SESSION['cart'])) {
			$_SESSION['cart'] = array();
		}

		if (isset($_SESSION['cart'][$get_product_id])) {
			$_SESSION['cart'][$get_product_id] += 1;
		}
		else{
			$_SESSION['cart'][$get_product_id] = 1;
		}

		print_r($_SESSION['cart']);
		
		// header('Location: ' . $_SERVER['HTTP_REFERER']);
		// exit;		
	}

 ?>