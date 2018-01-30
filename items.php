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
		<h1 class="title">
			<?php get_page_title(); ?> 
		</h1>
	</div>
	
	<div class="items-wrapper">
		<?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin'): ?>
			<div class="add-item-btn-outer">
				<span class="add-item-btn-inner">
					<input type="button" class="btn btn-secondary" id="add-item" name="add_item" value="Add Item">
				</span>
			</div>	
		<?php endif ?>
				<div class="row" id="data-row">
					<?php 
						
						if (isset($_GET['search_all'])) {
							require "all_items.php";
							function get_method(){
								echo "search_all";
							}
						}
						
					 	if (isset($_GET['new'])) {
					 		require "new_arrivals.php";
					 		function get_method(){
					 			echo "new";
					 		}
					 	}
						if (isset($_GET['allmen'])) {
							require "men.php";
							function get_method() {
								echo "allmen";
							}
						}

						if (isset($_GET['mshoe'])) {
							require "men.php";
							function get_method() {
								echo "men=true&mshoe";
							}
						}

						if (isset($_GET['mbag'])) {
							require "men.php";
							function get_method() {
								echo "men=true&mbag";
							}
						}

						if (isset($_GET['mtop'])) {
							require "men.php";
							function get_method() {
								echo "men=true&mtop";
							}
						}

						if (isset($_GET['allwomen'])) {
							require "women.php";
							function get_method() {
								echo "allwomen";
							}
						}

						if (isset($_GET['wshoe'])) {
						 	require "women.php";
						 	function get_method() {
								echo "women=true&wshoe";
							}
						}

						if (isset($_GET['wbag'])) {
						 	require "women.php";
						 	function get_method() {
								echo "women=true&wbag";
							}
						}
						if (isset($_GET['wtop'])) {
						 	require "women.php";
						 	function get_method() {
								echo "women=true&wtop";
							}
						}
						
						// if (isset($_GET['allen_edmonds'])) {
						// 	require "display_brands.php";
						// 	function get_method() {
						// 		echo "brand=true&allen_edmonds";
						// 	}
						// }

						foreach ($_GET as $key => $value) {
							switch ($key) {
							case 'allen_edmonds':
								require "display_brands.php";
								function get_method() {
									echo "brand=true&allen_edmonds";
								}
								break;
							case 'balenciaga' :
								require "display_brands.php";
								function get_method() {
									echo "brand=true&balenciaga";
								}	
								break;
							case 'berluti' :
								require "display_brands.php";
								function get_method() {
									echo "brand=true&berluti";
								}	
								break;
							case 'barba_napoli' :
								require "display_brands.php";
								function get_method() {
									echo "brand=true&barba_napoli";
								}	
								break;
							case 'brioni' :
								require "display_brands.php";
								function get_method() {
									echo "brand=true&brioni";
								}	
								break;
							case 'christian_louboutin' :
								require "display_brands.php";
								function get_method() {
									echo "brand=true&christian_louboutin";
								}	
								break;
							case 'gucci' :
								require "display_brands.php";
								function get_method() {
									echo "brand=true&gucci";
								}	
								break;
							case 'jimmy_choo' :
								require "display_brands.php";
								function get_method() {
									echo "brand=true&jimmy_choo";
								}	
								break;
							case 'kate_spade' :
								require "display_brands.php";
								function get_method() {
									echo "brand=true&kate_spade";
								}	
								break;
							case 'manolo_blahnik' :
								require "display_brands.php";
								function get_method() {
									echo "brand=true&manolo_blahnik";
								}	
								break;
							case 'ralph_lauren' :
								require "display_brands.php";
								function get_method() {
									echo "brand=true&ralph_lauren";
								}	
								break;
							case 'saint_laurent' :
								require "display_brands.php";
								function get_method() {
									echo "brand=true&saint_laurent";
								}	
								break;
							case 'salvatore_ferragamo' :
								require "display_brands.php";
								function get_method() {
									echo "brand=true&salvatore_ferragamo";
								}	
								break;
							case 'stuart_weitzman' :
								require "display_brands.php";
								function get_method() {
									echo "brand=true&stuart_weitzman";
								}	
								break;
							case 'versace' :
								require "display_brands.php";
								function get_method() {
									echo "brand=true&versace";
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
						<a class="page-btn" id="p_<?php echo $page; ?>" href="items.php?<?php get_method(); ?>=true&page=<?php echo $page; ?>"><?php echo $page; ?></a>
					</span>
			<?php endfor;?>
		</div>
		</div> <!-- /.items-wrapper -->

	

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
				$('.bg-custom').css('background-color', 'rgb(251,251,251)');
			}
			else {
				$('.bg-custom').css('background-color', 'transparent');
			}
		});
    </script>
</body>
</html>