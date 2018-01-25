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
					$subtotal = 0;
					foreach ($_SESSION['cart'] as $id => $total) :
						$sql = "SELECT * FROM products WHERE id = '$id'";
						$result = mysqli_query($connection,$sql);
						$row = mysqli_fetch_assoc($result);
						extract($row);

						$subtotal += $price*$total;
			?>

				<div class="row outer-row">
					<div class="image-col col-md-4">
						<img src="<?php echo $picture; ?>">
					</div>
					<div class="desc-col col-md-8">
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
									<span class="value">Php <?php echo number_format($price*$total,2); ?></span>
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
	<div class="box recap">
		<div class="change-shipping-info">
			You can change shipping method in the next step
		</div>
		<div class="price-recap">
			<div class="product-subtotal">
				<span>Subtotal:</span>
				<span class="price">
					<span>Php <?php echo number_format($subtotal,2); ?> </span>
				</span>
			</div>
			<div class="tax-recap">
				<span>Sales Tax:</span>
				<span class="tax-text">To be calculated</span>
			</div>
			<div class="shipping-recap">
				<span>Shipping: </span>
				<span class="shipping-text">Standard - Complimentary</span>
			</div>
		</div>
	</div>
	<div class="box proceed">
		<span class="back-to-shopping-btn">Back to shopping</span>
		<button class="next-page-button">
			<span>Proceed to checkout</span>
		</button>
	</div>
</div> <!-- /.container -->
	
	

	<?php require "assets/partials/footer.php" ?>
	<script src="assets/js/main.js" type="text/javascript"></script>
    <script type="text/javascript">
    </script>
</body>
</html>