<?php 
	require "connection.php";
	if (isset($_GET['edit_action'])) {
		$id = $_GET['id'];

		$product_name = mysqli_real_escape_string($connection, $_POST['product_name']);
		$description = mysqli_real_escape_string($connection, $_POST['description']);
		$price = mysqli_real_escape_string($connection, $_POST['price']);

		$sql = "UPDATE products SET 
				product_name = '$product_name',
				description = '$description',
				price = '$price'
				WHERE id = '$id'";
		mysqli_query($connection, $sql);
		header('location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}


	if (isset($_GET['delete_action'])) {
		$del_id = $_GET['del_id'];
		$sql = "DELETE FROM products WHERE id = '$del_id'";
		mysqli_query($connection, $sql);

		$sql = "SELECT * FROM products WHERE id = '$del_id'";
		$result = mysqli_query($connection, $sql);
		if (mysqli_num_rows($result) > 0) {
			$new_loc = (string)$_SERVER['HTTP_REFERER'];			
			echo "<script>alert('You cannot delete this item. Someone is currently buying this item.');
					window.location.replace(\"$new_loc\")</script>";
			exit;
		}

		header('location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	if (isset($_GET['add_item'])) {
		$now = new DateTime();
		$date = $now->format('Y-m-d');
		$file_name = strstr($_FILES['image']['name'], '.', true);
		$file_extension = strstr($_FILES['image']['name'], '.');	
		$target_dir = "assets/images/";
		$target_file = $target_dir . basename($file_name . "_" . $date . "_a" . $file_extension);
		move_uploaded_file($_FILES['image']['tmp_name'], $target_file);


		$product_name = $_POST['product_name'];
		$description = $_POST['description'];
		$picture = $target_file;
		$price = $_POST['price'];
		$brand_id = $_POST['brand'];
		$gender_id = $_POST['gender'];
		$product_type_id = $_POST['product_type'];

		$sql = "INSERT INTO products (product_name, description, price, picture, brand_id, gender_id, product_type_id ) VALUES 
			('$product_name', '$description', '$price', '$picture', '$brand_id', '$gender_id', '$product_type_id')";
		mysqli_query($connection,$sql) or die(mysqli_error($connection));
		header('location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	if (isset($_GET['ban_user'])) {
		$id = $_GET['user_id'];
		if (isset($_POST['delete-order'])) {
			$delete_order = $_POST['delete-order'];
			// $sql = "SELECT id as order_id FROM orders WHERE user_id = '$id'";
			// $result = mysqli_query($connection, $sql);
			// $row = mysqli_fetch_assoc($result);
			// extract($row);

			$sql = "DELETE FROM order_details WHERE order_id = (SELECT id as order_id FROM orders WHERE user_id = '$id'
					 AND status='pending')";
			mysqli_query($connection, $sql);
		}
		$sql = "UPDATE users SET status_id = 2 WHERE id = '$id'";
		mysqli_query($connection, $sql);
		header('location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	if (isset($_GET['unban_user'])) {
		$id = $_GET['user_id'];
		$sql = "UPDATE users SET status_id = 1 WHERE id = '$id'";
		mysqli_query($connection, $sql);
		header('location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	if (isset($_GET['complete_order'])) {
		$order_id = $_GET['order_id'];
		$sql = "UPDATE orders SET status = 'done' WHERE id = '$order_id'";
		mysqli_query($connection, $sql);
		header('location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	if (isset($_GET['delete_order'])) {
		$order_id = $_GET['order_id'];
		$sql = "DELETE FROM orders WHERE id = '$order_id'";
		mysqli_query($connection, $sql);
		header('location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	if (isset($_POST['admin_register'])) {
		
		$username = $_POST['username'];
		$password = sha1($_POST['password']);

		$sql = "INSERT INTO users (username, password, role_id, status_id)
				VALUES ('$username', '$password', 2, 1)";
		mysqli_query($connection, $sql);
		header('location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}
 ?>