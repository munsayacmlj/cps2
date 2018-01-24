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
		<h3>Shopping Cart</h3>
	</div>
	<div class="container cart-container">
		<div class="item-row" id="data-row">
			<?php 
				require "connection.php";

				if (isset($_SESSION['cart'])) :
					
					foreach ($_SESSION['cart'] as $id => $total) :
						$sql = "SELECT * FROM products WHERE id = '$id'";
						$result = mysqli_query($connection,$sql);
						$row = mysqli_fetch_assoc($result);
						extract($row);
			?>

				<div class="row outer-row">
					<div class="image-col col-md-4">
						<img src="<?php echo $picture; ?>">
					</div>
					<div class="desc-col col-md-7">
						<div class="brand">
							<span><?php echo $product_name; ?></span>
						</div>
						<div class="inner row">
							<div class="desc-size col-md-4">
								<div class="description">
									<span class="label">Description:</span>
									<span class="value"><?php echo $description; ?></span>
								</div>
								<div class="price">
									<span class="label">Price:</span>
									<span class="value">Php <?php echo $price; ?></span>
								</div>
							</div> <!-- /.desc-size -->

							<div class="change-quantity col-md-4">
								<span class="label">Quantity:</span>
								<span class="qty-value">
									<select name="Qty" class="selecta" id="<?php echo $id; ?>" data-index="<?php echo $id; ?>">
										<option value="1" <?php if ($total==1) echo "selected"; ?>>1</option>
										<option value="2" <?php if ($total==2) echo "selected"; ?>>2</option>
										<option value="3" <?php if ($total==3) echo "selected"; ?>>3</option>
										<option value="4" <?php if ($total==4) echo "selected"; ?>>4</option>
										<option value="5" <?php if ($total==5) echo "selected"; ?>>5</option>
									</select>
								</span>
							</div> <!-- /.change-quantity -->
							
							<div class="price-col col-md-4">
								<span class="del-item-c">
									<a href="endpoint.php?delete_item_from_cart=true&id=<?php echo $id; ?>"><li class="fa fa-trash fa-lg"></li></a>
								</span>
								<span class="price">
									<span class="value">Php <?php echo $price*$total; ?></span>
								</span>
							</div>

						</div> <!-- /.inner -->
					</div>
				</div>
			<?php			
					endforeach;
				endif;
			?>	
		</div> <!-- /.row -->
	</div> <!-- /.container -->
	
	<?php require "assets/partials/footer.php" ?>
	<script src="assets/js/main.js" type="text/javascript"></script>
    <script type="text/javascript">
    	$('.selecta').on('change', function() {
    		var id = $(this).data('index');
    		var qty = $('#'+id).val();
    		$.ajax({
    			url: 'endpoint.php',
    			type: 'POST',
    			data: {
    				qtyChange : true,
    				id: id,
    				qty: qty 
    			},
    			success:function(data){
    				// alert(data);
    				location.reload();
    			}
    		});
    	});
    </script>
</body>
</html>