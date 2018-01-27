<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <?php require "assets/partials/head.php"; ?>
    
</head>
<body>
	<?php require "assets/partials/top-nav.php" ?>
	<?php require "assets/partials/navigation.php" ?>
	<?php require "get_page_title.php"; ?>
	<div class="sort-text">
		<h1>
			<?php get_page_title(); ?> 
		</h1>
	</div>
	
	<div class="wrapper">
		<div class="row">
			<div class="left-side col-md-2">
				<?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin'): ?>
					<div class="add-item-btn-outer">
						<span class="add-item-btn-inner">
							<input type="button" class="btn btn-secondary" id="add-item" name="add_item" value="Add Item">
						</span>
					</div>	
				<?php endif ?>
				<?php 
					function get_filter($n){
						echo $n;
					}
				 ?>
				<div class="sort-links">
					<span> Filter <?php get_page_title(); ?></span>
					


				</div>
			</div>



			<div class="right-side col-md-10">
				<div class="row" id="data-row">
					<?php 
						require "connection.php";

						if (isset($_GET['search_all'])) {
							require "all_items.php";
						}
						
					 	if (isset($_GET['new'])) {
					 		require "new_arrivals.php";
					 	}
						if (isset($_GET['men'])) {
							require "men.php";
						}

						if (isset($_GET['women'])) {
							require "women.php";
						}

						if (isset($_GET['brand'])) {
							require "display_brands.php";
						}
					?>	
				</div> <!-- /.row -->
			</div> <!-- /.container -->
			
		</div>
	</div>

	

	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        
			      </div>
			    </div>
		  </div>
	</div>

	<?php require "assets/partials/footer.php" ?>
	<script src="assets/js/main.js" type="text/javascript"></script>
	<script src="assets/js/uglipop.js" type="text/javascript"></script>
    <script type="text/javascript">

    </script>
</body>
</html>