<?php 
	
	require "connection.php";
	session_start();



	if (isset($_POST['delete_account'])) {
		$username = $_SESSION['username'];
		$res = mysqli_query($connection, 
					"SELECT id FROM orders WHERE user_id = (SELECT id from users WHERE username = '$username')
						AND status = 'pending'"
					);
		if (mysqli_num_rows($res) > 0) {
			$row = extract(mysqli_fetch_assoc($res));
			echo $id;
		}
		else {
			
		}

		// $sql = "DELETE FROM users WHERE username = '$username'";
		// if(mysqli_query($connection, $sql)){
		// 	session_unset();
		// 	session_destroy();
		// 	header('location: index.php');	
		// }
	}
 ?>