<?php 
 	if (isset($_GET['top'])) {
 		$sql = "SELECT *, a.id as prod_id FROM 
			products a JOIN product_types b 
					ON (a.product_type_id = b.id) JOIN genders c 
					ON (a.gender_id = c.id ) WHERE type = 'shirt' AND gender = 'men'";
		$result = mysqli_query($connection, $sql);
		while($row = mysqli_fetch_assoc($result)):
		extract($row);
	 	require "display.php";
		endwhile; 
 	}

 	else if (isset($_GET['bag'])) {
 		$sql = "SELECT *, a.id as prod_id FROM 
			products a JOIN product_types b 
					ON (a.product_type_id = b.id) JOIN genders c 
					ON (a.gender_id = c.id ) WHERE type = 'bag' AND gender = 'men'";
		$result = mysqli_query($connection, $sql);
		while($row = mysqli_fetch_assoc($result)):
		extract($row);
	 	require "display.php";
		endwhile; 
 	}

 	else if (isset($_GET['shoe'])) {
 		$sql = "SELECT *, a.id as prod_id FROM 
			products a JOIN product_types b 
					ON (a.product_type_id = b.id) JOIN genders c 
					ON (a.gender_id = c.id ) WHERE type = 'shoes' AND gender = 'men'";
		$result = mysqli_query($connection, $sql);
		while($row = mysqli_fetch_assoc($result)):
		extract($row);
	 	require "display.php";
		endwhile; 
 	}

 	else{
 		$sql = "SELECT *, a.id as prod_id FROM products a JOIN genders b ON (a.gender_id = b.id) WHERE gender = 'men'";
		$result = mysqli_query($connection, $sql);
		while($row = mysqli_fetch_assoc($result)){
		extract($row);
	 	require "display.php";
		}
 	}
  ?>