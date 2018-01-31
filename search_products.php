<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <?php require "assets/partials/head.php"; ?>
    
</head>
<body class="body-with-footer">
	<?php require "assets/partials/top-nav.php" ?>
	<?php require "assets/partials/navigation.php" ?>
	<?php require "get_page_title.php"; ?>
	<div class="sort-text">
		<h1>
			<?php get_page_title(); ?> 
		</h1>
	</div>
	
	<div class="items-wrapper container">
		<div class="row" id="data-row">
			<?php 
			 	if (isset($_GET['search_item'])) {
			 		$name = $_GET['search_item'];
		$results_per_page = 8;

		$sql = "SELECT *, a.id as prod_id, b.brand_name as brand, c.type as type FROM products a JOIN brands b ON 
				(a.brand_id = b.id) JOIN product_types c ON (a.product_type_id = c.id) WHERE a.product_name LIKE '$name%'
			 	OR b.brand_name LIKE '$name%' OR c.type LIKE '$name%'";
		$res = mysqli_query($connection, $sql);
		$num_of_rows = mysqli_num_rows($res);

		$num_of_pages = ceil($num_of_rows / $results_per_page);
		if (isset($_GET['page'])) 
			$page = $_GET['page'];
		else
			$page = 1;


		$this_page_result = ($page - 1) * $results_per_page;

			 		$sql = "SELECT *, a.id as prod_id, b.brand_name as brand, c.type as type FROM products a JOIN brands b ON (a.brand_id = b.id)
			 				JOIN product_types c ON (a.product_type_id = c.id) WHERE a.product_name LIKE '$name%'
			 				OR b.brand_name LIKE '$name%' OR c.type LIKE '$name%' LIMIT " . $this_page_result . ',' .$results_per_page;
			 		$result = mysqli_query($connection, $sql);
			 		
			 		while ($row = mysqli_fetch_assoc($result)) {
			 			extract($row);
			 			require "display.php";
			 		}
			 	}

		    ?>
		</div> <!-- /.row -->
		<div class="page-btns-container" id="pageDiv">
			<?php for ($page=1; $page <= $num_of_pages; $page++) : ?>
					<span>
						<a class="page-btn" id="p_<?php echo $page; ?>" href="search_products.php?search_item=<?php echo $name; ?>&page=<?php echo $page; ?>"><?php echo $page; ?></a>
					</span>
			<?php endfor;?>
		</div>
	</div> <!-- /.container /.items-wrapper -->
	<?php 
		if (isset($_GET['page'])) {
			echo '<script type="text/javascript">
		    $(document).ready(function(){';

		    $from_url = $_GET['page'];

		    echo '
		    $(\'#p_' . $from_url . '\').addClass(\'active\');
		        });
		    </script>';
	    }
	?>
	<?php require "assets/partials/footer.php" ?>
	<script src="assets/js/main.js" type="text/javascript"></script>
    <script type="text/javascript">
    	

    </script>
</body>
</html>