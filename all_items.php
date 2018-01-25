<?php 

		$sql = "SELECT * FROM products";
		$result = mysqli_query($connection, $sql);
		while($row = mysqli_fetch_assoc($result)):
		extract($row);
	 	require "display.php";
		endwhile; 

 ?>