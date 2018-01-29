<?php 
 	if (isset($_GET['mtop'])) {
 		$results_per_page = 8;

		$sql = "SELECT * FROM products a JOIN genders b ON (a.gender_id = b.id)
				JOIN product_types c ON (a.product_type_id = c.id) WHERE gender = 'men' AND type = 'shirt'";
		$res = mysqli_query($connection, $sql);
		$num_of_rows = mysqli_num_rows($res);

		$num_of_pages = ceil($num_of_rows / $results_per_page);
		if (isset($_GET['page'])) 
			$page = $_GET['page'];
		else
			$page = 1;


		$this_page_result = ($page - 1) * $results_per_page;

 		$sql = "SELECT *, a.id as prod_id FROM 
			products a JOIN product_types b 
					ON (a.product_type_id = b.id) JOIN genders c 
					ON (a.gender_id = c.id ) WHERE type = 'shirt' AND gender = 'men' LIMIT " . $this_page_result . ',' . $results_per_page;
		$result = mysqli_query($connection, $sql);
		while($row = mysqli_fetch_assoc($result)):
		extract($row);
	 	require "display.php";
		endwhile; 
 	}

 	else if (isset($_GET['mbag'])) {
 		$results_per_page = 8;

		$sql = "SELECT * FROM products a JOIN genders b ON (a.gender_id = b.id)
				JOIN product_types c ON (a.product_type_id = c.id) WHERE gender = 'men' AND type = 'bag'";
		$res = mysqli_query($connection, $sql);
		$num_of_rows = mysqli_num_rows($res);

		$num_of_pages = ceil($num_of_rows / $results_per_page);
		if (isset($_GET['page'])) 
			$page = $_GET['page'];
		else
			$page = 1;


		$this_page_result = ($page - 1) * $results_per_page;

 		$sql = "SELECT *, a.id as prod_id FROM 
			products a JOIN product_types b 
					ON (a.product_type_id = b.id) JOIN genders c 
					ON (a.gender_id = c.id ) WHERE type = 'bag' AND gender = 'men' LIMIT " . $this_page_result . ',' . $results_per_page;
		$result = mysqli_query($connection, $sql);
		while($row = mysqli_fetch_assoc($result)):
		extract($row);
	 	require "display.php";
		endwhile; 
 	}

 	else if (isset($_GET['mshoe'])) {

 		$results_per_page = 8;

		$sql = "SELECT * FROM products a JOIN genders b ON (a.gender_id = b.id)
				JOIN product_types c ON (a.product_type_id = c.id) WHERE gender = 'men' AND type = 'shoes'";
		$res = mysqli_query($connection, $sql);
		$num_of_rows = mysqli_num_rows($res);

		$num_of_pages = ceil($num_of_rows / $results_per_page);
		if (isset($_GET['page'])) 
			$page = $_GET['page'];
		else
			$page = 1;


		$this_page_result = ($page - 1) * $results_per_page;

 		$sql = "SELECT *, a.id as prod_id FROM 
			products a JOIN product_types b 
					ON (a.product_type_id = b.id) JOIN genders c 
					ON (a.gender_id = c.id ) WHERE type = 'shoes' AND gender = 'men' LIMIT " . $this_page_result . ',' . $results_per_page;
		$result = mysqli_query($connection, $sql);
		while($row = mysqli_fetch_assoc($result)):
		extract($row);
	 	require "display.php";
		endwhile; 
 	}

 	else{
 		$results_per_page = 8;

		$sql = "SELECT * FROM products JOIN genders ON (products.gender_id = genders.id) WHERE gender = 'men'";
		$res = mysqli_query($connection, $sql);
		$num_of_rows = mysqli_num_rows($res);

		$num_of_pages = ceil($num_of_rows / $results_per_page);
		if (isset($_GET['page'])) 
			$page = $_GET['page'];
		else
			$page = 1;


		$this_page_result = ($page - 1) * $results_per_page;

 		$sql = "SELECT *, a.id as prod_id FROM products a JOIN genders b ON (a.gender_id = b.id) WHERE gender = 'men' 
 				LIMIT " . $this_page_result . ',' . $results_per_page;
		$result = mysqli_query($connection, $sql);
		while($row = mysqli_fetch_assoc($result)){
		extract($row);
	 	require "display.php";
		}
 	}
  ?>