<?php 
		$results_per_page = 8;

		$sql = "SELECT * FROM products";
		$res = mysqli_query($connection, $sql);
		$num_of_rows = mysqli_num_rows($res);

		$num_of_pages = ceil($num_of_rows / $results_per_page);
		if (isset($_GET['page'])) 
			$page = $_GET['page'];
		else
			$page = 1;


		$this_page_result = ($page - 1) * $results_per_page;


		$sql = "SELECT *, products.id as prod_id FROM products LIMIT " . $this_page_result. ',' . $results_per_page;
		$res = mysqli_query($connection, $sql);
		while($row = mysqli_fetch_assoc($res)):
		extract($row);
	 	require "display.php";
		endwhile; 
 ?>