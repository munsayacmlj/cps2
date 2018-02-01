<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <?php require "assets/partials/head.php"; ?>
    
</head>
<body id="index-body" class="body-with-footer">
	<?php require "assets/partials/top-nav.php" ?>
	<?php require "assets/partials/home-nav.php" ?>
	<?php require "get_page_title.php"; ?>
	<div class="wrapper">
		<div class="top-bg" data-zoom>
			<a href="#!" class="home-link">
				<img src="assets/images/bg/girl.jpg" class="primary" height="1328" width="1920" style="display: inline-block;">
				<div class="title-wrap">
					<div class="caption">
						<h3 style="text-align: center;">
							<strong>NEW ARRIVALS 2018</strong>
						</h3>
						<h4 style="text-align: center;">Discover more</h4>
					</div>
				</div>	
			</a>
		</div>
		<div class="mid-bg">
			<a class="home-link" href="items.php?new=true&page=1" >
				<img src="assets/images/bg/boy.jpg" class="primary" alt="New Arriavals 2018" title="New Arrivals 2018" height="1328" width="1920" style="display: inline-block;">
				<div class="title-wrap">
					<div class="caption">
						<h3 style="text-align: center;">
							<strong>NEW ARRIVALS 2018</strong>
						</h3>
						<h4 style="text-align: center;">Discover more</h4>
					</div>
				</div>	
			</a>
		</div>
		<div class="bottom-bg">
			<a class="home-link" href="#!">
				<img src="assets/images/bg/Brioni_Store_Paris.jpg" class="primary" height="1328" width="1920" style="display: inline-block;">
				<div class="title-wrap">
					<div class="caption">
						<h3 style="text-align: center;">
							<strong>STORE LOCATOR</strong>
						</h3>
						<h4 style="text-align: center;">Discover more</h4>
					</div>
				</div>	
			</a>
		</div>
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
	<?php 
		if (isset($_GET['msg'])) : ?>
			<script> alertify.alert("Notification", "Message sent successfully!").show();</script>
	<?php endif; ?>
	<?php require "assets/partials/footer.php" ?>
	<script src="assets/js/main.js" type="text/javascript"></script>
	<script src="assets/js/alertify.js" type="text/javascript"></script>
    <script type="text/javascript">
    	var scrollStart = 0;
		var startChange = $(".wrapper");
		var offset = startChange.offset();
		$(document).scroll(function() {
			scroll_start = $(this).scrollTop();
			if (scroll_start > offset.top) {
				$('.home-nav-border').css('border-bottom', 'none');
				$('.nav-link-index').css('color', '#fff');
				$('.home-search').css('color', '#fff');
				$('.home-logo').css('height', '100px');
			}
			else {
				$('.home-nav-bg').css('background-color', 'transparent');
				$('.nav-link-index').css('color', '#000');
				$('.home-search').css('color', '#000');
				$('.home-logo').css('height', '65px');
			}
		});
    </script>
</body>
</html>