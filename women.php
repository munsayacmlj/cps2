<?php 
 	if (isset($_GET['wtop'])) {
 		$results_per_page = 8;

		$sql = "SELECT * FROM products a JOIN genders b ON (a.gender_id = b.id) JOIN product_types c 
				ON (a.product_type_id = c.id) WHERE gender = 'women' AND type = 'shirt'";
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
					ON (a.gender_id = c.id ) WHERE type = 'shirt' AND gender = 'women' LIMIT " . $this_page_result . ',' . $results_per_page;
		$result = mysqli_query($connection, $sql);
		while($row = mysqli_fetch_assoc($result)):
		extract($row);
	 	require "display.php";
		endwhile; 
 	}

 	else if (isset($_GET['wbag'])) {
 		$results_per_page = 8;

		$sql = "SELECT * FROM products a JOIN genders b ON (a.gender_id = b.id) JOIN product_types c 
				ON (a.product_type_id = c.id) WHERE gender = 'women' AND type = 'bag'";
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
					ON (a.gender_id = c.id ) WHERE type = 'bag' AND gender = 'women' LIMIT " . $this_page_result . ',' . $results_per_page;
		$result = mysqli_query($connection, $sql);
		while($row = mysqli_fetch_assoc($result)):
		extract($row);
	 	require "display.php";
		endwhile; 
 	}

 	else if (isset($_GET['wshoe'])) {
 		$results_per_page = 8;

		$sql = "SELECT * FROM products a JOIN genders b ON (a.gender_id = b.id) JOIN product_types c 
				ON (a.product_type_id = c.id) WHERE gender = 'women' AND type = 'shoes'";
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
					ON (a.gender_id = c.id ) WHERE type = 'shoes' AND gender = 'women' LIMIT " . $this_page_result . ',' . $results_per_page;
		$result = mysqli_query($connection, $sql);
		while($row = mysqli_fetch_assoc($result)):
		extract($row);
	 	require "display.php";
		endwhile; 
 	}

 	else{
 		$results_per_page = 8;

		$sql = "SELECT * FROM products JOIN genders ON (products.gender_id = genders.id) WHERE gender = 'women'";
		$res = mysqli_query($connection, $sql);
		$num_of_rows = mysqli_num_rows($res);

		$num_of_pages = ceil($num_of_rows / $results_per_page);
		if (isset($_GET['page'])) 
			$page = $_GET['page'];
		else
			$page = 1;


		$this_page_result = ($page - 1) * $results_per_page;

 		$sql = "SELECT *, a.id as prod_id FROM products a JOIN genders b ON (a.gender_id = b.id)
 				 WHERE gender = 'women' LIMIT " . $this_page_result . ',' . $results_per_page;
		$result = mysqli_query($connection, $sql);
		while($row = mysqli_fetch_assoc($result)):
		extract($row);
	 	require "display.php";
		endwhile;
 	}
  ?>