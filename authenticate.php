<?php 
	
	require "connection.php";
	session_start();

	if (isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
		$result = mysqli_query($connection, $sql);

		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			$_SESSION['username'] = $username;
			$_SESSION['role'] = $row['role'];
			header('location: index.php');
		}
		else{
			echo "Failed to login. Incorrect login credentials. <br>";
			echo "Login again <a href='login.php' style='color: red'>here</a>";
		}
	}

 ?>