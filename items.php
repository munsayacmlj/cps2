<!DOCTYPE html>
<html lang="en">
<head>
    <title>MLJM Shop</title>
    <?php require "assets/partials/head.php"; ?>
    
</head>
<body class="body-with-footer">
	<?php require "assets/partials/top-nav.php" ?>
	<?php require "assets/partials/navigation.php" ?>
	<?php require "get_page_title.php"; ?>
	<div class="sort-text">
		<h1 class="title">
			<?php get_page_title(); ?> 
		</h1>
	</div>
	
	<div class="items-wrapper container">
		<?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin'): ?>
			<div class="add-item-btn-outer">
				<span class="add-item-btn-inner">
					<input type="button" class="btn btn-secondary" id="add-item" name="add_item" value="Add Item">
				</span>
			</div>	
		<?php endif ?>
				<div class="row" id="data-row">
					<?php 
						if (isset($_GET['new'])) {
					 		require "new_arrivals.php";
					 		function get_method(){
					 			echo "new";
					 		}
					 	}
						elseif (isset($_GET['allmen'])) {
							require "men.php";
							function get_method() {
								echo "allmen";
							}
						}
						elseif (isset($_GET['mshoe'])) {
							require "men.php";
							function get_method() {
								echo "mshoe";
							}
						}
						elseif (isset($_GET['mbag'])) {
							require "men.php";
							function get_method() {
								echo "mbag";
							}
						}
						elseif (isset($_GET['mtop'])) {
							require "men.php";
							function get_method() {
								echo "mtop";
							}
						}
						elseif (isset($_GET['allwomen'])) {
							require "women.php";
							function get_method() {
								echo "allwomen";
							}
						}
						elseif (isset($_GET['wshoe'])) {
						 	require "women.php";
						 	function get_method() {
								echo "wshoe";
							}
						}
						elseif (isset($_GET['wbag'])) {
						 	require "women.php";
						 	function get_method() {
								echo "wbag";
							}
						}
						elseif (isset($_GET['wtop'])) {
						 	require "women.php";
						 	function get_method() {
								echo "wtop";
							}
						}
						elseif (isset($_GET['search_all'])) {
					 		require "all_items.php";
								function get_method(){
									echo "search_all";
								}
					 	}

						foreach ($_GET as $key => $value) {
							switch ($key) {
							case 'allen_edmonds':
								require "display_brands.php";
								function get_method() {
									echo "allen_edmonds";
								}
								break;
							case 'balenciaga' :
								require "display_brands.php";
								function get_method() {
									echo "balenciaga";
								}	
								break;
							case 'berluti' :
								require "display_brands.php";
								function get_method() {
									echo "berluti";
								}	
								break;
							case 'barba_napoli' :
								require "display_brands.php";
								function get_method() {
									echo "barba_napoli";
								}	
								break;
							case 'brioni' :
								require "display_brands.php";
								function get_method() {
									echo "brioni";
								}	
								break;
							case 'christian_louboutin' :
								require "display_brands.php";
								function get_method() {
									echo "christian_louboutin";
								}	
								break;
							case 'gucci' :
								require "display_brands.php";
								function get_method() {
									echo "gucci";
								}	
								break;
							case 'jimmy_choo' :
								require "display_brands.php";
								function get_method() {
									echo "jimmy_choo";
								}	
								break;
							case 'kate_spade' :
								require "display_brands.php";
								function get_method() {
									echo "kate_spade";
								}	
								break;
							case 'manolo_blahnik' :
								require "display_brands.php";
								function get_method() {
									echo "manolo_blahnik";
								}	
								break;
							case 'ralph_lauren' :
								require "display_brands.php";
								function get_method() {
									echo "ralph_lauren";
								}	
								break;
							case 'saint_laurent' :
								require "display_brands.php";
								function get_method() {
									echo "saint_laurent";
								}	
								break;
							case 'salvatore_ferragamo' :
								require "display_brands.php";
								function get_method() {
									echo "salvatore_ferragamo";
								}	
								break;
							case 'stuart_weitzman' :
								require "display_brands.php";
								function get_method() {
									echo "stuart_weitzman";
								}	
								break;
							case 'versace' :
								require "display_brands.php";
								function get_method() {
									echo "versace";
								}	
								break;
							default:
							break;
							} /* switch */
						}
					?>
				</div> <!-- /.row -->
				
		<div class="page-btns-container" id="pageDiv">
			<?php for ($page=1; $page <= $num_of_pages; $page++) : ?>
					<span>
						<a class="page-btn" id="p_<?php echo $page; ?>" href="items.php?page=<?php echo $page; ?>&<?php get_method(); ?>=true"><?php echo $page; ?></a>
					</span>
			<?php endfor;?>
		</div>
	</div> <!-- /.items-wrapper /.container -->

	

	<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
	<script src="assets/js/main.js" type="text/javascript"></script>
	<script src="assets/js/alertify.js" type="text/javascript"></script>
	<script src="assets/js/uglipop.js" type="text/javascript"></script>
    <script type="text/javascript">

    	var scrollStart = 0;
		var startChange = $("#data-row");
		var offset = startChange.offset();
		$(document).scroll(function() {
			scroll_start = $(this).scrollTop();
			if (scroll_start > offset.top) {
				$('.bg-custom').css('background-color', '#fff');
				$('.home-logo').css('height', '100px');
			}
			else {
				$('.bg-custom').css('background-color', 'transparent');
				$('.home-logo').css('height', '65px');
			}
		});
    </script>
</body>
</html>