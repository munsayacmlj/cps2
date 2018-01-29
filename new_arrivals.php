<?php 
		$results_per_page = 4;

		$sql = "SELECT * FROM products LIMIT 8";
		$res = mysqli_query($connection, $sql);
		$num_of_rows = mysqli_num_rows($res);

		$num_of_pages = ceil($num_of_rows / $results_per_page);
		if (isset($_GET['page'])) 
			$page = $_GET['page'];
		else
			$page = 1;


		$this_page_result = ($page - 1) * $results_per_page;

		$sql = "SELECT *, a.id as prod_id, b.brand_name as brand FROM products a JOIN brands b ON (a.brand_id = b.id) ORDER BY a.id DESC LIMIT " . $this_page_result . ',' . $results_per_page;
		$result = mysqli_query($connection, $sql);
		while($row = mysqli_fetch_assoc($result)):
		extract($row);
		require "display.php";
		endwhile;
?>