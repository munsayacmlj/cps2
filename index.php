<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <?php require "assets/partials/head.php"; ?>
    
</head>
<body id="index-body">
	<?php require "assets/partials/top-nav.php" ?>
	<?php require "assets/partials/home-nav.php" ?>
	<?php require "get_page_title.php"; ?>
	<div class="wrapper">
		
	
		
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
	<?php 
		if (isset($_GET['msg'])) : ?>
			<script> alertify.alert("Notification", "Message sent successfully!").show();</script>
	<?php endif; ?>
	<?php require "assets/partials/footer.php" ?>
	<script src="assets/js/main.js" type="text/javascript"></script>
	<script src="assets/js/alertify.js" type="text/javascript"></script>
    <script type="text/javascript">
    </script>
</body>
</html>