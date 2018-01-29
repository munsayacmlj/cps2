<?php 
	if (isset($_GET['allen_edmonds'])) {
		$results_per_page = 8;

		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Allen Edmonds'";
		$res = mysqli_query($connection, $sql);
		$num_of_rows = mysqli_num_rows($res);

		$num_of_pages = ceil($num_of_rows / $results_per_page);
		if (isset($_GET['page'])) 
			$page = $_GET['page'];
		else
			$page = 1;


		$this_page_result = ($page - 1) * $results_per_page;

		$sql = "SELECT *, a.id as prod_id FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Allen Edmonds' LIMIT " . $this_page_result . ',' . $results_per_page;
		$result = mysqli_query($connection, $sql);
		// print_r($result);
		while($row = mysqli_fetch_assoc($result)):
		extract($row);
	 	
	 	require "display.php";
	 	
		 endwhile;
	}

	if (isset($_GET['balenciaga'])) {
		$results_per_page = 8;

		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Balenciaga'";
		$res = mysqli_query($connection, $sql);
		$num_of_rows = mysqli_num_rows($res);

		$num_of_pages = ceil($num_of_rows / $results_per_page);
		if (isset($_GET['page'])) 
			$page = $_GET['page'];
		else
			$page = 1;


		$this_page_result = ($page - 1) * $results_per_page;

		$sql = "SELECT *, a.id as prod_id FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Balenciaga' LIMIT ". $this_page_result . ',' . $results_per_page;
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			require "display.php";
		}
	}

	if (isset($_GET['barba_napoli'])) {
		$results_per_page = 8;

		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Barba Napoli'";
		$res = mysqli_query($connection, $sql);
		$num_of_rows = mysqli_num_rows($res);

		$num_of_pages = ceil($num_of_rows / $results_per_page);
		if (isset($_GET['page'])) 
			$page = $_GET['page'];
		else
			$page = 1;


		$this_page_result = ($page - 1) * $results_per_page;

		$sql = "SELECT *, a.id as prod_id FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Barba Napoli' LIMIT ". $this_page_result . ',' . $results_per_page;
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			require "display.php";
		}
	}

	if (isset($_GET['berluti'])) {
		$results_per_page = 8;

		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Berluti'";
		$res = mysqli_query($connection, $sql);
		$num_of_rows = mysqli_num_rows($res);

		$num_of_pages = ceil($num_of_rows / $results_per_page);
		if (isset($_GET['page'])) 
			$page = $_GET['page'];
		else
			$page = 1;


		$this_page_result = ($page - 1) * $results_per_page;

		$sql = "SELECT *, a.id as prod_id FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Berluti' LIMIT ". $this_page_result . ',' . $results_per_page;
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			require "display.php";
		}
	}

	if (isset($_GET['brioni'])) {
		$results_per_page = 8;

		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Brioni'";
		$res = mysqli_query($connection, $sql);
		$num_of_rows = mysqli_num_rows($res);

		$num_of_pages = ceil($num_of_rows / $results_per_page);
		if (isset($_GET['page'])) 
			$page = $_GET['page'];
		else
			$page = 1;


		$this_page_result = ($page - 1) * $results_per_page;

		$sql = "SELECT *, a.id as prod_id FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Brioni' LIMIT ". $this_page_result . ',' . $results_per_page;
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			require "display.php";
		}
	}

	if (isset($_GET['christian_louboutin'])) {
		$results_per_page = 8;

		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Christian Louboutin'";
		$res = mysqli_query($connection, $sql);
		$num_of_rows = mysqli_num_rows($res);

		$num_of_pages = ceil($num_of_rows / $results_per_page);
		if (isset($_GET['page'])) 
			$page = $_GET['page'];
		else
			$page = 1;


		$this_page_result = ($page - 1) * $results_per_page;

		$sql = "SELECT *, a.id as prod_id FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Christian Louboutin' LIMIT ". $this_page_result . ',' . $results_per_page;
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			require "display.php";
		}
	}

	if (isset($_GET['gucci'])) {
		$results_per_page = 8;

		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Gucci'";
		$res = mysqli_query($connection, $sql);
		$num_of_rows = mysqli_num_rows($res);

		$num_of_pages = ceil($num_of_rows / $results_per_page);
		if (isset($_GET['page'])) 
			$page = $_GET['page'];
		else
			$page = 1;


		$this_page_result = ($page - 1) * $results_per_page;

		$sql = "SELECT *, a.id as prod_id FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Gucci' LIMIT ". $this_page_result . ',' . $results_per_page;
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			require "display.php";
		}
	}

	if (isset($_GET['jimmy_choo'])) {
		$results_per_page = 8;

		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Jimmy Choo'";
		$res = mysqli_query($connection, $sql);
		$num_of_rows = mysqli_num_rows($res);

		$num_of_pages = ceil($num_of_rows / $results_per_page);
		if (isset($_GET['page'])) 
			$page = $_GET['page'];
		else
			$page = 1;


		$this_page_result = ($page - 1) * $results_per_page;

		$sql = "SELECT *, a.id as prod_id FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Jimmy Choo' LIMIT ". $this_page_result . ',' . $results_per_page;
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			require "display.php";
		}
	}

	if (isset($_GET['kate_spade'])) {
		$results_per_page = 8;

		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Kate Spade'";
		$res = mysqli_query($connection, $sql);
		$num_of_rows = mysqli_num_rows($res);

		$num_of_pages = ceil($num_of_rows / $results_per_page);
		if (isset($_GET['page'])) 
			$page = $_GET['page'];
		else
			$page = 1;


		$this_page_result = ($page - 1) * $results_per_page;

		$sql = "SELECT *, a.id as prod_id FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Kate Spade' LIMIT ". $this_page_result . ',' . $results_per_page;
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			require "display.php";
		}
	}

	if (isset($_GET['manolo_blahnik'])) {
		$results_per_page = 8;

		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Manolo Blahnik'";
		$res = mysqli_query($connection, $sql);
		$num_of_rows = mysqli_num_rows($res);

		$num_of_pages = ceil($num_of_rows / $results_per_page);
		if (isset($_GET['page'])) 
			$page = $_GET['page'];
		else
			$page = 1;


		$this_page_result = ($page - 1) * $results_per_page;

		$sql = "SELECT *, a.id as prod_id FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Manolo Blahnik' LIMIT ". $this_page_result . ',' . $results_per_page;
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			require "display.php";
		}
	}

	if (isset($_GET['ralph_lauren'])) {
		$results_per_page = 8;

		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Ralph Lauren'";
		$res = mysqli_query($connection, $sql);
		$num_of_rows = mysqli_num_rows($res);

		$num_of_pages = ceil($num_of_rows / $results_per_page);
		if (isset($_GET['page'])) 
			$page = $_GET['page'];
		else
			$page = 1;


		$this_page_result = ($page - 1) * $results_per_page;

		$sql = "SELECT *, a.id as prod_id FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Ralph Lauren' LIMIT ". $this_page_result . ',' . $results_per_page;
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			require "display.php";
		}
	}

	if (isset($_GET['saint_laurent'])) {
		$results_per_page = 8;

		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Saint Laurent'";
		$res = mysqli_query($connection, $sql);
		$num_of_rows = mysqli_num_rows($res);

		$num_of_pages = ceil($num_of_rows / $results_per_page);
		if (isset($_GET['page'])) 
			$page = $_GET['page'];
		else
			$page = 1;


		$this_page_result = ($page - 1) * $results_per_page;

		$sql = "SELECT *, a.id as prod_id FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Saint Laurent' LIMIT ". $this_page_result . ',' . $results_per_page;
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			require "display.php";
		}
	}

	if (isset($_GET['salvatore_ferragamo'])) {
		$results_per_page = 8;

		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Salvatore Ferragamo'";
		$res = mysqli_query($connection, $sql);
		$num_of_rows = mysqli_num_rows($res);

		$num_of_pages = ceil($num_of_rows / $results_per_page);
		if (isset($_GET['page'])) 
			$page = $_GET['page'];
		else
			$page = 1;


		$this_page_result = ($page - 1) * $results_per_page;

		$sql = "SELECT *, a.id as prod_id FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Salvatore Ferragamo' LIMIT ". $this_page_result . ',' . $results_per_page;
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			require "display.php";
		}
	}

	if (isset($_GET['stuart_weitzman'])) {
		$results_per_page = 8;

		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Stuart Weitzman'";
		$res = mysqli_query($connection, $sql);
		$num_of_rows = mysqli_num_rows($res);

		$num_of_pages = ceil($num_of_rows / $results_per_page);
		if (isset($_GET['page'])) 
			$page = $_GET['page'];
		else
			$page = 1;


		$this_page_result = ($page - 1) * $results_per_page;

		$sql = "SELECT *, a.id as prod_id FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Stuart Weitzman' LIMIT ". $this_page_result . ',' . $results_per_page;
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			require "display.php";
		}
	}

	if (isset($_GET['versace'])) {
		$results_per_page = 8;

		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Versace'";
		$res = mysqli_query($connection, $sql);
		$num_of_rows = mysqli_num_rows($res);

		$num_of_pages = ceil($num_of_rows / $results_per_page);
		if (isset($_GET['page'])) 
			$page = $_GET['page'];
		else
			$page = 1;


		$this_page_result = ($page - 1) * $results_per_page;

		$sql = "SELECT *, a.id as prod_id FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Versace' LIMIT ". $this_page_result . ',' . $results_per_page;
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			require "display.php";
		}
	}
?>