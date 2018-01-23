<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <?php require "assets/partials/head.php"; ?>
    
</head>
<body>
	<?php require "assets/partials/top-nav.php" ?>
	<?php require "assets/partials/navigation.php" ?>
	<div class="container">
		<div class="row" id="data-row">
			<?php 
				require "connection.php";
				
			 	if (isset($_GET['new'])) {
			 		require "new_arrivals.php";
			 	}
			 	if (isset($_GET['men']) && isset($_GET['top'])) {
			 		require "top-men.php";
			 	}
			 	else if (isset($_GET['men']) && isset($_GET['bag'])) {
					require "bag-men.php";
				}
				else if(isset($_GET['men']) && isset($_GET['shoe'])){
					require "shoe-men.php";
				}
				else if (isset($_GET['men'])) {
					require "men.php";     
				}

				if (isset($_GET['women']) && isset($_GET['top'])) {
					require "top-women.php";
				}
				else if (isset($_GET['women']) && isset($_GET['bag'])) {
					require "bag-women.php";
				}
				else if (isset($_GET['women']) && isset($_GET['shoe'])) {
					require "shoe-women.php";
				}
				else if(isset($_GET['women'])){
					require "women.php";
				}

				if (isset($_GET['allen_edmonds'])) {
					require "allen_edmonds.php";
				}
			?>	
		</div> <!-- /.row -->
	</div> <!-- /.container -->
	<?php require "assets/partials/footer.php" ?>
	<script src="assets/js/main.js" type="text/javascript"></script>
    <script type="text/javascript">
    
    </script>
</body>
</html>