<?php 
		$sql = "SELECT *, a.id as prod_id, b.brand_name as brand FROM products a JOIN brands b ON (a.brand_id = b.id) ORDER BY a.id DESC LIMIT 10";
		$result = mysqli_query($connection, $sql);
		while($row = mysqli_fetch_assoc($result)):
		extract($row);
		require "display.php";
		endwhile;
?>