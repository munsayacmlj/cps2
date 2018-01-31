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
	
	<div id="wish-wrapper">
		<div id="wish-list-wrapper">
			<ol class="wish-list-items row">
		<?php 
			require "connection.php";
			if (isset($_SESSION['wish'])) : ?>
					<?php if (empty($_SESSION['wish'])): ?>
						<li class="wish-title empty-wish-list col-12">
							<div>
								<h5>Wish List</h5>
								<p>Save up to ten of your most wanted items to follow their availability and add them directly to your Shopping Bag.</p>
							</div>
						</li>
					<?php else: ?>
						<li class="wish-title col-md-4">
							<div>
								<h5>Wish List</h5>
								<p>Save up to ten of your most wanted items to follow their availability and add them directly to your Shopping Bag.</p>
							</div>
						</li>
					<?php endif ?>
			
		<?php		foreach ($_SESSION['wish'] as $product_id => $total) :
					$sql = "SELECT *, b.brand_name as brand_name FROM products a JOIN brands b ON (a.brand_id = b.id) JOIN wishlists c ON (a.id = c.product_id) WHERE c.product_id = '$product_id'";
					$result = mysqli_query($connection, $sql);
					$row = mysqli_fetch_assoc($result);
					extract($row);
					// print_r($row);
		?>
					<li class="col-md-4" id="<?php echo $product_id; ?>">
						<div class="wish-items">
							<div class="edit">
								<button class="remove-wish-item" type="button" data-product-id="<?php echo $product_id; ?>">
									<span class="text">Remove product</span>
								</button>
							</div>
							<div class="prod-img">
								<img src="<?php echo $picture; ?>">
							</div>
							<div class="info">
								<div class="product-name">
									<span><?php echo $product_name; ?></span>
								</div>
								<div class="wish-brand-name">
									<span class="label">Brand: </span>
									<span class="value"><?php echo $brand_name; ?></span>
								</div>
								<div class="price">
									<span class="label">Php </span>
									<span class="value"><?php echo number_format($price,2); ?></span>
								</div>
								<div class="description">
									<span class="label">Description: </span>
									<span class="value"><?php echo $description; ?></span>
								</div>
							</div>
							<button class="btn btn-black add-btn shop-btn" data-id="<?php echo $product_id; ?>">Add to Shopping Bag</button>
						</div>
					</li>	

					<?php endforeach; ?>
			<?php else: ?>
			<li class="wish-title col-md-12">
				<div>
					<h5>Wish List</h5>
					<p>Save up to ten of your most wanted items to follow their availability and add them directly to your Shopping Bag.</p>
				</div>
			</li>

			<?php endif; ?>
			</ol>
		
			
			
		</div>
	</div>

	<script src="assets/js/main.js" type="text/javascript"></script>
	<script src="assets/js/uglipop.js" type="text/javascript"></script>
    <script type="text/javascript">
    	$('.wish-list-items').on('click', '.remove-wish-item', function() {

    			var product_id = $(this).data('product-id');

    			$.ajax({
    				url: 'endpoint.php',
    				type: 'POST',
    				data:{
    					rm_wish_item: true,
    					product_id : product_id
    				},
    				success:function(data) {
    					 var delay = alertify.get('notifier','delay');
						 alertify.set('notifier','delay', 2);
    					 alertify.set('notifier','position', 'top-right');
						 alertify.warning('Product has been removed.');
						 alertify.set('notifier','delay', delay);
						 $('#'+product_id).remove();
						 $('#div-wish-list').load(' #div-wish-list');
						 $('.wish-list-items').load(' .wish-list-items');
    				}
    			});
    	})
    		// $('.remove-wish-item').click(function() {
    		// });
    </script>
</body>
</html>