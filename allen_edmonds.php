<?php 

	$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Allen Edmonds'";
	$result = mysqli_query($connection, $sql);
	while($row = mysqli_fetch_assoc($result)):
	extract($row);
 	
 	require "display.php";
 	
 endwhile; ?>