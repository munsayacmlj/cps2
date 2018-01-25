	
	<div class="col-xs-12 col-md-3 card" id=<?php echo $prod_id; ?> data-index=<?php echo $prod_id; ?> style="width: 20rem; border: none; margin-bottom: 4em;" onmouseover="getId(this);">
		 <div class="image-box center-img">
			  <img class="card-img-top" src="<?php echo $picture; ?>">
		 </div>
		 <div class="card-block">
		    <div class="card-content">
			    <div class="product-name">
				    <span class="card-title product-name"><?php echo $product_name; ?></span>
			    </div>
			    <div class="price-tag">
				    <span class="product-price">Php <?php echo number_format($price,2); ?></span>
			    </div>

			    <?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin' ) : ?>
			    <div class="admin-link-items">
			    	<div class="edit-width">
			    		<span class="edit-link edit-item left" data-toggle="modal" data-target="#myModal" data-index="<?php echo $prod_id; ?>">Edit</span>
			    	</div>
			    	<div class="delete-width">
			    		<span class="delete-link delete-item" data-toggle="modal" data-target="#myModal" data-index="<?php echo $prod_id; ?>">
			    			<i class="fa fa-trash fa-lg right"></i>
			    		</span>
			    	</div>
			    </div>	
			    <?php elseif (isset($_SESSION['username'])) : ?>
			    	<a href="endpoint.php?add_to_cart=true&id=<?php echo $prod_id; ?>" class="shop-link">Shop This &gt;</a>
				<?php endif; ?>
		    </div>
		 </div>
	</div>