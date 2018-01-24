<?php 
	if (isset($_GET['allen_edmonds'])) {
		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Allen Edmonds'";
		$result = mysqli_query($connection, $sql);
		while($row = mysqli_fetch_assoc($result)):
		extract($row);
	 	
	 	require "display.php";
	 	
		 endwhile;
	}

	if (isset($_GET['balenciaga'])) {
		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Balenciaga'";
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			require "display.php";
		}
	}

	if (isset($_GET['barba_napoli'])) {
		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Barba Napoli'";
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			require "display.php";
		}
	}

	if (isset($_GET['berluti'])) {
		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Berluti'";
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			require "display.php";
		}
	}

	if (isset($_GET['brioni'])) {
		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Brioni'";
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			require "display.php";
		}
	}

	if (isset($_GET['christian_louboutin'])) {
		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Christian Louboutin'";
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			require "display.php";
		}
	}

	if (isset($_GET['gucci'])) {
		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Gucci'";
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			require "display.php";
		}
	}

	if (isset($_GET['jimmy_choo'])) {
		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Jimmy Choo'";
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			require "display.php";
		}
	}

	if (isset($_GET['kate_spade'])) {
		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Kate Spade'";
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			require "display.php";
		}
	}

	if (isset($_GET['manolo_blahnik'])) {
		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Manolo Blahnik'";
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			require "display.php";
		}
	}

	if (isset($_GET['ralph_lauren'])) {
		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Ralph Lauren'";
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			require "display.php";
		}
	}

	if (isset($_GET['saint_laurent'])) {
		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Saint Laurent'";
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			require "display.php";
		}
	}

	if (isset($_GET['salvatore_ferragamo'])) {
		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Salvatore Ferragamo'";
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			require "display.php";
		}
	}

	if (isset($_GET['stuart_weitzman'])) {
		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Stuart Weitzman'";
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			require "display.php";
		}
	}

	if (isset($_GET['versace'])) {
		$sql = "SELECT * FROM products a JOIN brands b
				ON (a.brand_id = b.id) WHERE brand_name = 'Versace'";
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			require "display.php";
		}
	}
?>