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
		$row = mysqli_fetch_assoc($result);


		if(mysqli_num_rows($result) == 0){
			$sql = "INSERT INTO orders (order_date, user_id, status) VALUES ('$date', '$user_id', 'pending')";
			mysqli_query($connection, $sql);
		} /* if not existing*/

		// if ($row['status'] == 'done') {
		// 	$sql = "INSERT INTO orders (order_date, user_id, status) VALUES ('$date', '$user_id', 'pending')";
		// 	mysqli_query($connection, $sql);
		// }

		$sql = "SELECT * FROM orders WHERE user_id = '$user_id' AND status = 'pending'";
		$result = mysqli_query($connection, $sql);
		// $row = mysqli_fetch_assoc($result);
		// extract($row);
		// print_r($row);
		if (mysqli_num_rows($result) > 0) {   /* if there is a pending order from the session user*/
			
			$sql = "SELECT id as order_id FROM orders WHERE user_id = '$user_id' AND status = 'pending'";
			$result = mysqli_query($connection, $sql);
			$row = mysqli_fetch_assoc($result);
			extract($row);
			$new_order_id = $order_id; /* order_id of pending order*/
			// echo $new_order_id;

			
			$sql = "SELECT * FROM products WHERE id = $get_product_id";
			$result = mysqli_query($connection, $sql);
			$row = mysqli_fetch_assoc($result);
			extract($row);
			$extracted_product_id = $id;   
			$extracted_price = $price;
			
			
			$sql = "SELECT COUNT(quantity) as qty FROM order_details WHERE product_id = '$extracted_product_id'";
			$result = mysqli_query($connection, $sql);
			$row = mysqli_fetch_assoc($result);
			extract($row);
			if($qty >= 5){
					$new_loc = (string)$_SERVER['HTTP_REFERER'];			
					echo "<script>alert('You cannot order the same item more than 5 times.');
							window.location.replace(\"$new_loc\")</script>";
			}
			else{
				$sql = "INSERT INTO order_details (quantity, total_price, product_id, order_id)
							VALUES (1, '$extracted_price', '$extracted_product_id', '$new_order_id')";
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
			}	
		} /* if */
		else{  /* if there is no pending order from the session user */

			$sql = "INSERT INTO orders (order_date, user_id, status) VALUES ('$date', '$user_id', 'pending')";
			mysqli_query($connection, $sql);

			$sql = "SELECT id as order_id FROM orders WHERE user_id = '$user_id' AND status = 'pending'";
			$result = mysqli_query($connection, $sql);
			$row = mysqli_fetch_assoc($result);
			extract($row);
			$new_order_id = $order_id; /* order_id of pending order*/
			// echo $new_order_id;

			
			$sql = "SELECT * FROM products WHERE id = $get_product_id";
			$result = mysqli_query($connection, $sql);
			$row = mysqli_fetch_assoc($result);
			extract($row);
			$extracted_product_id = $id;   
			$extracted_price = $price;
			
			
			$sql = "SELECT COUNT(quantity) as qty FROM order_details WHERE product_id = '$extracted_product_id'";
			$result = mysqli_query($connection, $sql);
			$row = mysqli_fetch_assoc($result);
			extract($row);
			if($qty >= 5){
					$new_loc = (string)$_SERVER['HTTP_REFERER'];			
					echo "<script>alert('You cannot order the same item more than 5 times.');
							window.location.replace(\"$new_loc\")</script>";
			}
			else{
				$sql = "INSERT INTO order_details (quantity, total_price, product_id, order_id)
							VALUES (1, '$extracted_price', '$extracted_product_id', '$new_order_id')";
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
			}	
		}	
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	if (isset($_POST['qtyChange'])) {
		session_start();
		$product_id = $_POST['id']; /*product_id*/
		$quantity = $_POST['qty'];
		// echo $product_id."    ".$quantity;

		$sql = "SELECT COUNT(quantity) as db_qty FROM order_details WHERE product_id = '$product_id'";
		$result = mysqli_query($connection, $sql);
		$row = mysqli_fetch_assoc($result);
		extract($row);
		if ($quantity < $db_qty) {
			// echo $quantity;
			// echo $db_qty;
			while ($quantity < $db_qty) {
				$sql = "DELETE FROM order_details WHERE product_id = '$product_id' LIMIT 1";
				mysqli_query($connection, $sql);

				$_SESSION['cart'][$product_id] -= 1;

				$sql = "SELECT COUNT(quantity) as db_qty FROM order_details WHERE product_id = '$product_id'";
				$result = mysqli_query($connection, $sql);
				$row = mysqli_fetch_assoc($result);
				extract($row);
			}
			// echo $db_qty;
		}

		if ($quantity > $db_qty) {
			$sql = "SELECT price FROM products WHERE id = '$product_id'";
			$result = mysqli_query($connection, $sql);
			$row = mysqli_fetch_assoc($result);
			extract($row); /* $price */

			$username = $_SESSION['username'];
			
			$sql = "SELECT a.id as order_id FROM orders a JOIN users b ON (a.user_id = b.id) WHERE username = '$username' AND status = 'pending'";
			$result = mysqli_query($connection, $sql);
			$row = mysqli_fetch_assoc($result);
			extract($row); /* $order_id */
			
			while ($quantity > $db_qty) {
				$sql = "INSERT INTO order_details (quantity, total_price, product_id, order_id) 
						VALUES (1, '$price', '$product_id', '$order_id')";
				mysqli_query($connection, $sql);
				
				$_SESSION['cart'][$product_id] += 1;


				$sql = "SELECT COUNT(quantity) as db_qty FROM order_details WHERE product_id = '$product_id'";
				$result = mysqli_query($connection, $sql);
				$row = mysqli_fetch_assoc($result);
				extract($row);
			}
		}
		
	}

	if (isset($_GET['delete_item_from_cart'])) {
		session_start();
		$id = $_GET['id'];
		unset($_SESSION['cart'][$id]);

		$sql = "DELETE FROM order_details WHERE product_id = '$id'";
		mysqli_query($connection, $sql);
		header('location: '. $_SERVER['HTTP_REFERER']);
		exit;
	}

 ?>