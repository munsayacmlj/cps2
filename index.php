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
	<div class="container">
		<div class="row" id="data-row">
			<?php 
				require "connection.php";
				
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
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="button" class="btn btn-primary">Save changes</button>
			      </div>
			    </div>
		  </div>
	</div>
	<?php require "assets/partials/footer.php" ?>
	<script src="assets/js/main.js" type="text/javascript"></script>
    <script type="text/javascript">
	    	// $('.shop-link').click(function() {
	    	// 	$.ajax({
	    	// 		url: 'endpoint.php',
	    	// 		type: 'POST',
	    	// 		data: {five:true},
	    	// 		success:function(data){
	    	// 			// alert(data);
	    	// 			$('.shop-link').html(data);
	    	// 		}
	    	// 	});
	    	// });
    </script>
</body>
</html>