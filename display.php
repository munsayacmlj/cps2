	
	<div class="col-xs-12 col-md-3 card" style="width: 20rem; border: none; margin-bottom: 4em;">
		 <div class="image-box center-img">
			  <img class="card-img-top" src="<?php echo $picture; ?>" alt="Card image cap">
		 </div>
		 <div class="card-block">
		    <div class="card-content">
			    <div class="card-text-contents">
				    <span class="card-title product_name"><?php echo $product_name; ?></span>
				    <p class="card-text">Php <?php echo $price; ?></p>
			    </div>

			    <?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin' ) : ?>
			    <div class="admin-link-items">
			    	<div class="edit-width"><a href="#" class="edit-link left">Edit</a></div>
			    	<div class="delete-width"><a href="#"><i class="fa fa-trash fa-lg right"></i></a></div>
			    </div>	
			    <?php elseif (isset($_SESSION['username'])) : ?>
			    	<a href="endpoint.php?add_to_cart=true&id=<?php echo $prod_id; ?>" class="shop-link">Shop This &gt;</a>
				<?php endif; ?>
		    </div>
		 </div>
	</div>