<?php 

	$sql = "SELECT * FROM 
			products a JOIN product_types b 
					ON (a.product_type_id = b.id) JOIN genders c 
					ON (a.gender_id = c.id ) WHERE type = 'shoes' AND gender = 'women'";
	$result = mysqli_query($connection, $sql);
	while($row = mysqli_fetch_assoc($result)):
	extract($row);
 	require "display.php";
 endwhile; 
 ?>