<?php 	
	require "connection.php";

	if (isset($_POST['register'])) { /* register account endpoint */
		
		$first_name = $_POST['firstname'];
		$last_name = $_POST['lastname'];
		$username = $_POST['reg-username'];
		$password = sha1($_POST['reg-password']);

		$sql = "SELECT * FROM users WHERE username = '$username'";
		$res = mysqli_query($connection, $sql);
		if (mysqli_num_rows($res) == 0) {
			$sql = "INSERT INTO users (first_name, last_name, username, password, role_id, status_id)
					VALUES ('$first_name', '$last_name', '$username', '$password', 1, 1)";
			mysqli_query($connection, $sql);
			header('location: login.php');
			exit;
		}
		else{
			$new_loc = (string)$_SERVER['HTTP_REFERER'];
			echo "<script>alert('Username exists!');
							window.location.replace(\"$new_loc\")</script>";
		}
	}
	if (isset($_GET['add_to_cart'])) {
		session_start();

		/* VARIABLES */
		$get_product_id = $_GET['id']; /* products.id*/
		$now = new DateTime();
		$date = $now->format('Y-m-d H:i:s');
		$username = $_SESSION['username'];


		$sql = "SELECT id FROM users WHERE username = '$username'";   /* GET THE USER ID*/
		$result = mysqli_query($connection, $sql);
		$row = mysqli_fetch_assoc($result);
		extract($row);
		$user_id = $id; /*$id from $row, id of the user*/

		$sql = "SELECT * FROM orders WHERE user_id = $user_id";
		$result = mysqli_query($connection, $sql);
		$row = mysqli_fetch_assoc($result);


		if(mysqli_num_rows($result) == 0){  /* if not existing*/
			$sql = "INSERT INTO orders (order_date, user_id, status) VALUES ('$date', '$user_id', 'pending')";
			mysqli_query($connection, $sql);
		} 

		$sql = "SELECT * FROM orders WHERE user_id = '$user_id' AND status = 'pending'";
		$result = mysqli_query($connection, $sql);
		
		if (mysqli_num_rows($result) > 0) {   /* if there is a pending order from the session user*/
			
			$sql = "SELECT id as order_id FROM orders WHERE user_id = '$user_id' AND status = 'pending'";
			$result = mysqli_query($connection, $sql);
			$row = mysqli_fetch_assoc($result);
			extract($row);
			$new_order_id = $order_id; /* order_id of pending order*/

			
			$sql = "SELECT * FROM products WHERE id = $get_product_id";
			$result = mysqli_query($connection, $sql);
			$row = mysqli_fetch_assoc($result);
			extract($row);
			$extracted_product_id = $id;   
			$extracted_price = $price;
			
			
			$sql = "SELECT COUNT(quantity) as qty FROM order_details WHERE product_id = '$extracted_product_id'
					AND order_id = '$new_order_id'";
			$result = mysqli_query($connection, $sql);
			$row = mysqli_fetch_assoc($result);
			extract($row);
			if($qty >= 5){
					// $new_loc = (string)$_SERVER['HTTP_REFERER'];			
					// echo "<script>alert('You cannot order the same item more than 5 times.');
					// 		window.location.replace(\"$new_loc\")</script>";
				echo 5;
			}
			else{
				$sql = "INSERT INTO order_details (quantity, total_price, product_id, order_id)
							VALUES (1, '$extracted_price', '$extracted_product_id', '$new_order_id')";
				mysqli_query($connection, $sql);
				
				if (empty($_SESSION['cart'])) {
					$_SESSION['cart'] = array();
				}

				if (isset($_SESSION['cart'][$get_product_id])) {
					$_SESSION['cart'][$get_product_id] += 1;
				}
				else{
					$_SESSION['cart'][$get_product_id] = 1;
				}
			}	
		} /* if */
		else{  /* if there is no pending order from the session user */

			$sql = "INSERT INTO orders (order_date, user_id, status) VALUES ('$date', '$user_id', 'pending')";
			mysqli_query($connection, $sql); /* creates pending order */

			$sql = "SELECT id as order_id FROM orders WHERE user_id = '$user_id' AND status = 'pending'";
			$result = mysqli_query($connection, $sql);
			$row = mysqli_fetch_assoc($result);
			extract($row);
			$new_order_id = $order_id; /* order_id of pending order*/
			// echo $new_order_id;

			
			$sql = "SELECT * FROM products WHERE id = $get_product_id";
			$result = mysqli_query($connection, $sql);
			$row = mysqli_fetch_assoc($result);
			extract($row);
			$extracted_product_id = $id;   
			$extracted_price = $price;
			
			
			$sql = "SELECT COUNT(quantity) as qty FROM order_details WHERE product_id = '$extracted_product_id'
					AND order_id = '$new_order_id'";
			$result = mysqli_query($connection, $sql);
			$row = mysqli_fetch_assoc($result);
			extract($row);
			if($qty >= 5){
				echo 5;
			}
			else{
				$sql = "INSERT INTO order_details (quantity, total_price, product_id, order_id)
							VALUES (1, '$extracted_price', '$extracted_product_id', '$new_order_id')";
				mysqli_query($connection, $sql);
				
				if (empty($_SESSION['cart'])) {
					$_SESSION['cart'] = array();
				}

				if (isset($_SESSION['cart'][$get_product_id])) {
					$_SESSION['cart'][$get_product_id] += 1;
				}
				else{
					$_SESSION['cart'][$get_product_id] = 1;
				}
			}	
		}	
	}
	if (isset($_POST['add_to_wish'])) {
		session_start();
		$prod_id = $_POST['prod_id'];
		$username = $_SESSION['username'];

		$sql = "SELECT id as user_id FROM users WHERE username = '$username'";
		$result = mysqli_query($connection, $sql);
		$row = mysqli_fetch_assoc($result);
		extract($row); /* $user_id */

		$sql = "SELECT COUNT(product_id) as num_product FROM wishlists WHERE product_id = '$prod_id'";
		$result = mysqli_query($connection, $sql);
		$row = mysqli_fetch_assoc($result);
		extract($row); /* $num_product */

		if ($num_product >= 1) {
			echo "You have already saved this product in your Wish List";
		}
		else {
			$sql = "INSERT INTO wishlists (user_id, product_id) VALUES ('$user_id', '$prod_id')";
			mysqli_query($connection, $sql);

			if (isset($_SESSION['wish'][$prod_id])) {
					$_SESSION['wish'][$prod_id] += 1;	
			}		
			else{
				$_SESSION['wish'][$prod_id] = 1;
			}
			echo 'success';
		}
	}
	if (isset($_POST['qtyChange'])) {   /* CHANGE ITEM'S QUANTITY*/
		session_start();
		$product_id = $_POST['id']; /*product_id*/
		$quantity = $_POST['qty'];
		// echo $product_id."    ".$quantity;

		$sql = "SELECT COUNT(quantity) as db_qty FROM order_details WHERE product_id = '$product_id'";
		$result = mysqli_query($connection, $sql);
		$row = mysqli_fetch_assoc($result);
		extract($row); /* extracted $db_qty as the total count of items in the database where product_id = $product_id */
		if ($quantity < $db_qty) {
			while ($quantity < $db_qty) {
				$sql = "DELETE FROM order_details WHERE product_id = '$product_id' LIMIT 1";
				mysqli_query($connection, $sql);

				$_SESSION['cart'][$product_id] -= 1;

				$sql = "SELECT COUNT(quantity) as db_qty FROM order_details WHERE product_id = '$product_id'";
				$result = mysqli_query($connection, $sql);
				$row = mysqli_fetch_assoc($result);
				extract($row); /* extracted $db_qty for comparison */
			}
			echo 'changed';
		}
		if ($quantity > $db_qty) {
			$sql = "SELECT price FROM products WHERE id = '$product_id'";
			$result = mysqli_query($connection, $sql);
			$row = mysqli_fetch_assoc($result);
			extract($row); /* $price */

			$username = $_SESSION['username'];
			
			$sql = "SELECT a.id as order_id FROM orders a JOIN users b ON (a.user_id = b.id) WHERE username = '$username' AND status = 'pending'";
			$result = mysqli_query($connection, $sql);
			$row = mysqli_fetch_assoc($result);
			extract($row); /* $order_id */
			
			while ($quantity > $db_qty) {
				$sql = "INSERT INTO order_details (quantity, total_price, product_id, order_id) 
						VALUES (1, '$price', '$product_id', '$order_id')";
				mysqli_query($connection, $sql);
				
				$_SESSION['cart'][$product_id] += 1;


				$sql = "SELECT COUNT(quantity) as db_qty FROM order_details WHERE product_id = '$product_id'";
				$result = mysqli_query($connection, $sql);
				$row = mysqli_fetch_assoc($result);
				extract($row);
			}
			echo 'changed';
		}
		
	}
	if (isset($_GET['delete_item_from_cart'])) {
		session_start();
		$id = $_GET['id'];
		unset($_SESSION['cart'][$id]);

		$sql = "DELETE FROM order_details WHERE product_id = '$id'";
		mysqli_query($connection, $sql);
		echo 0;
		header('location: '. $_SERVER['HTTP_REFERER']);
		exit;
	}
	if (isset($_POST['edit_item'])) :
		$prod_id = $_POST['index'];
		$sql = "SELECT *, b.gender as gender, b.id as gender_id, c.id as product_type_id, c.type as product_type FROM products a JOIN genders b ON (a.gender_id = b.id) JOIN product_types c 
				ON (a.product_type_id = c.id) WHERE a.id = '$prod_id'";
		$result = mysqli_query($connection, $sql);
		$product_row = mysqli_fetch_assoc($result);
		extract($product_row);

		$sql = "SELECT brand_name, a.id as brand_id FROM brands a JOIN products b ON (a.id = b.brand_id)
					WHERE b.id = '$prod_id'";
		$result = mysqli_query($connection, $sql);
		$brand_row = mysqli_fetch_assoc($result);
		extract($brand_row); /* $brand_name */
?>
 	<div class="brand-name-edit-modal">
		<h3><?php echo $brand_name; ?></h3>
	</div>
	<form id="modal-form" action="admin_action.php?edit_action=true&id=<?php echo $prod_id; ?>" method="POST" class="edit-form">
        <div class="inner-form">
        	<div class="pic-container">
	            <img id="modal-img" src="<?php echo $picture; ?>">
        	</div>
            <div class="form-group">
                <label>Name:</label> 
                <input class="form-control" id="modal-name" type="text" name="product_name" value="<?php echo $product_name; ?>">
            </div>
            <div class="form-group">
                <label>Description:</label> 
                <textarea class="form-control" id="modal-description" name="description"><?php echo $description; ?></textarea>
            </div>
			<div class="form-inline">
	            <select class="form-control selectables" name="brand" required>
	                <option selected value="<?php echo $brand_id ?>"><?php echo $brand_name; ?></option>
	                <?php 
	                $sql = "SELECT * FROM brands ORDER BY brand_name DESC";
	                $result = mysqli_query($connection, $sql);
	                while($row = mysqli_fetch_assoc($result)) :
	                    extract($row);
	                 ?>
	                    <option value="<?php echo $id; ?>"><?php echo $brand_name ?></option>
	                <?php endwhile; ?>
	            </select>

	            <select class="form-control selectables" name="gender" required>
	                <option selected value="<?php echo $gender_id; ?>"><?php echo $gender; ?></option>
	                <?php 
	                $sql = "SELECT * FROM genders";
	                $result = mysqli_query($connection, $sql);
	                while($row = mysqli_fetch_assoc($result)) :
	                    extract($row);
	                 ?>
	                    <option value="<?php echo $id; ?>"><?php echo $gender; ?></option>
	                <?php endwhile; ?>
	            </select>

	            <select class="form-control selectables" name="product_type" required>
	                <option selected value="<?php echo $product_type_id; ?>"><?php echo $product_type ?></option>
	                <?php 
	                $sql = "SELECT * FROM product_types";
	                $result = mysqli_query($connection, $sql);
	                while($row = mysqli_fetch_assoc($result)) :
	                    extract($row);
	                 ?>
	                    <option value="<?php echo $id; ?>"><?php echo $type; ?></option>
	                <?php endwhile; ?>
	            </select>
			</div>
            <div class="form-group">
                <label>Price: Php</label> 
                <input class="form-control" id="modal-price" name="price" type="number" min=0 value="<?php echo $price; ?>"> 
            </div>
            <div class="btns">
                <input type="button" class="btn btn-danger" data-dismiss="modal" name="" value="Cancel">
                <input id="save-btn" type="submit" class="btn btn-success" name="" value="Save Changes" name="edit">
            </div>
        </div>
    </form>
<?php
	endif;
 ?>
 <?php 
 	if (isset($_POST['delete_item'])) :
 		$id = $_POST['index'];
 		$sql = "SELECT *, a.id as del_id FROM products a JOIN brands b ON (a.brand_id = b.id) WHERE a.id = '$id'";
 		$result = mysqli_query($connection, $sql);
 		$row = mysqli_fetch_assoc($result);
 		extract($row);
  ?>

  			<h4 class="warning">Are you sure you want to delete this item?</h4>
  			<div class="name-picture-del-modal">
  				<div class="inner-brand">
	  				<span class="delete-brand-name"><?php echo $brand_name;  ?></span>
  				</div>
  				<div class="inner-name">
		            <span class="delete-item-name"><?php echo $product_name ?></span>
  				</div>
	            <img class="delete-item-img" src="<?php echo $picture ?>">
  			</div>
            <form id="delete-form" action="admin_action.php?delete_action=true&del_id=<?php echo $del_id ?>" method="POST">
	            <input type="submit" class="btn btn-danger delete-body" value="Yes">
	            <input type="button" class="btn btn-success" data-dismiss='modal' value="No">
            </form>
  			<!-- <input type="button" class="btn btn-danger delete-body" data-id="<?php echo $del_id; ?>" value="Yes">
            <input type="button" class="btn btn-success" data-dismiss='modal' value="No"> -->
<?php endif; ?>
<?php 
	if (isset($_POST['add_item'])) :
?>	
	<div class="container add-item-modal">
		<div class="row">
		        <form class="form-group col-12" action="admin_action.php?add_item=true" method="post" enctype="multipart/form-data">
					<div class="input-desc form-group col-12">
						<label for="product_name">Name</label>
						<input class="form-control" type="text" id="product_name" name="product_name" required>
					</div>
					
					<div class="form-group col-12">
			            <label for="description">Description</label>
			            <textarea class="form-control" id="description" name="description" required></textarea>
					</div>

					<div class="form-group col-12">
			            <label for="price">Price</label>
			            <input class="form-control" type="number" name="price" id="price" min=0 required>
					</div>

					<div class="form-group col-12">
			            <label for="image">Image</label>
						<input class="form-control" type="file" name="image" id="image" required>
					</div>

					<div class="form-inline selects">
			            <select class="form-control selectables" name="brand" required>
			                <option disabled selected>Brand Name</option>
			                <?php 
			                $sql = "SELECT * FROM brands ORDER BY brand_name DESC";
			                $result = mysqli_query($connection, $sql);
			                while($row = mysqli_fetch_assoc($result)) :
			                    extract($row);
			                 ?>
			                    <option value="<?php echo $id ?>"><?php echo $brand_name ?></option>
			                <?php endwhile; ?>
			            </select>


			            <select class="form-control selectables" name="gender" required>
			                <option disabled selected>Men/Women</option>
			                <?php 
			                $sql = "SELECT * FROM genders";
			                $result = mysqli_query($connection, $sql);
			                while($row = mysqli_fetch_assoc($result)) :
			                    extract($row);
			                 ?>
			                    <option value="<?php echo $id ?>"><?php echo $gender; ?></option>
			                <?php endwhile; ?>
			            </select>

			            <select class="form-control selectables" name="product_type" required>
			                <option disabled selected>Type</option>
			                <?php 
			                $sql = "SELECT * FROM product_types";
			                $result = mysqli_query($connection, $sql);
			                while($row = mysqli_fetch_assoc($result)) :
			                    extract($row);
			                 ?>
			                    <option value="<?php echo $id ?>"><?php echo $type; ?></option>
			                <?php endwhile; ?>
			            </select>
					</div>

					<div class="form-inline">
						<div class="add-item-footer-btns">
				            <input type="submit" name="submit" class="btn btn-success" value="Add Item">
						</div>
						<div class="add-item-footer-btns">
				            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancel" name="">
						</div>
					</div>
		        </form>
		</div>
	</div>
<?php	
	endif;
 ?>
<?php 
	if (isset($_POST['ban'])) :
		$id = $_POST['id']; 
		$sql = "SELECT *, a.id as user_id, b.role_name as role, c.status as status, COUNT(e.quantity) as total_items, d.status as order_status FROM users a JOIN roles b ON (a.role_id = b.id) JOIN user_status c ON (a.status_id = c.id) JOIN orders d ON (a.id = d.user_id) JOIN order_details e ON (d.id = e.order_id) WHERE a.id = $id AND d.status = 'pending'";
		$result = mysqli_query($connection, $sql);
		$row = mysqli_fetch_assoc($result);
		extract($row);
		// echo $total_items . " " . $order_status;
?>
			<h4 class="warning">Are you sure you want to ban this user?</h4>
  			<div class="ban-user">
  				<div class="first-last-name form-group">
  					<label for="names">Name</label>
	  				<span class="form-control" id="names"><?php echo $first_name . " " .$last_name;  ?></span>
  				</div>
  				<div class="role form-group">
  					<label for="user-role">Role</label>
		            <span class="form-control" id="user-role"><?php echo $role; ?></span>
  				</div>
  				<div class="ban-username form-group">
  					<label for="username">Username: </label>
					<span class="form-control" id="username"><?php echo $username; ?></span>
  				</div>
  				<div class="pending-orders form-group">
  					<label for="order">Order: </label>
					<span class="form-control" id="order"><?php echo $order_status; ?></span>
	  				<label for="quantity-ordered">Number of items: </label>
					<span class="form-control" id="quantity-ordered"><?php echo $total_items; ?></span>
  				</div>
  			</div> <!-- /.ban-user -->
            <form id="delete-form" action="admin_action.php?ban_user=true&user_id=<?php echo $user_id ?>" method="POST">
  				<div class="form-group">
  					<input type="checkbox" name="delete-order" id="delete-orders" <?php if($order_status == NULL) echo "disabled"; ?>>
  					<label for="delete-orders" class="form-check-label">Delete orders of this user?</label>
  				</div>
	            <input type="submit" class="btn btn-danger" value="Yes">
	            <input type="button" class="btn btn-success" data-dismiss='modal' value="No">
            </form>
<?php endif; ?>
<?php 
	if (isset($_POST['unban'])) :
		$id = $_POST['id'];
		
		$sql = "SELECT *, a.id as user_id, b.role_name as role, c.status as status, COUNT(e.quantity) as total_items, d.status as order_status FROM users a JOIN roles b ON (a.role_id = b.id) JOIN user_status c ON (a.status_id = c.id) JOIN orders d ON (a.id = d.user_id) JOIN order_details e ON (d.id = e.order_id) WHERE a.id = $id AND d.status = 'pending'";
		$result = mysqli_query($connection, $sql);
		$row = mysqli_fetch_assoc($result);
		extract($row);
?>
			<h4 class="warning">Do you want to unban this user?</h4>
  			<div class="ban-user">
  				<div class="first-last-name form-group">
  					<label for="names">Name</label>
	  				<span class="form-control" id="names"><?php echo $first_name . " " .$last_name;  ?></span>
  				</div>
  				<div class="role form-group">
  					<label for="user-role">Role</label>
		            <span class="form-control" id="user-role"><?php echo $role; ?></span>
  				</div>
  				<div class="ban-username">
  					<label for="username">Username: </label>
					<span class="form-control" id="username"><?php echo $username; ?></span>
  				</div>
  				<div class="pending-orders form-group">
  					<label for="order">Order: </label>
					<span class="form-control" id="order"><?php echo $order_status; ?></span>
	  				<label for="quantity-ordered">Number of items: </label>
					<span class="form-control" id="quantity-ordered"><?php echo $total_items; ?></span>
  				</div>
  			</div>
            <form id="delete-form" action="admin_action.php?unban_user=true&user_id=<?php echo $user_id ?>" method="POST">
	            <input type="submit" class="btn btn-success" value="Yes">
	            <input type="button" class="btn btn-danger" data-dismiss='modal' value="No">
            </form>
<?php endif; ?>
<?php 
	if (isset($_POST['order_complete'])) :
		$order_id = $_POST['order_id'];
		$user_id = $_POST['user_id'];
		
		$sql = "SELECT *, a.username as username, COUNT(quantity) as quantity_ordered FROM users a JOIN orders b ON (a.id = b.user_id)
				JOIN order_details c ON (b.id = c.order_id) WHERE a.id = '$user_id' AND b.id = '$order_id'";
		$result = mysqli_query($connection, $sql);
		$row = mysqli_fetch_assoc($result);
		extract($row);
		// print_r($row);
		// echo $username . " " . $order_id . " " . $quantity_ordered;
?>
			<h4 class="warning">Do you want to complete this order?</h4>
  			<div class="ban-user">
  				<div class="ban-username form-group">
  					<label for="username">Username:</label>
					<span class="form-control" id="username"><?php echo $username; ?></span>
  				</div>
  				
  				<div class="first-last-name form-group">
  					<label for="names">Order ID:</label>
	  				<span class="form-control" id="names"><?php echo $order_id; ?></span>
  				</div>


  				<div class="pending-orders form-group">
  					<label for="order">Orders: </label>
					<span class="form-control" id="order"><?php echo $quantity_ordered; ?></span>
  				</div>
  			</div>
            <form id="delete-form" action="admin_action.php?complete_order=true&order_id=<?php echo $order_id ?>" method="POST">
	            <input type="submit" class="btn btn-success" value="Yes">
	            <input type="button" class="btn btn-danger" data-dismiss='modal' value="No">
            </form>

<?php endif; ?>
<?php 
	if (isset($_POST['order_delete'])) :
		$order_id = $_POST['order_id'];
		$username = $_POST['username'];
		$quantity_ordered = $_POST['quantity'];
?>
			<div class="warning">
				<h4>Do you want to delete this order?</h4>
				<h6>This will also delete all items in the cart.</h6>
			</div>
  			<div class="ban-user">
  				<div class="ban-username form-group">
  					<label for="username">Username:</label>
					<span class="form-control" id="username"><?php echo $username; ?></span>
  				</div>
  				
  				<div class="first-last-name form-group">
  					<label for="names">Order ID:</label>
	  				<span class="form-control" id="names"><?php echo $order_id; ?></span>
  				</div>


  				<div class="pending-orders form-group">
  					<label for="order">Orders: </label>
					<span class="form-control" id="order"><?php echo $quantity_ordered; ?></span>
  				</div>
  			</div>
            <form id="delete-form" action="admin_action.php?delete_order=true&order_id=<?php echo $order_id ?>" method="POST">
	            <input type="submit" class="btn btn-success" value="Yes">
	            <input type="button" class="btn btn-danger" data-dismiss='modal' value="No">
            </form>
<?php	endif; ?>
<?php 
	if (isset($_POST['view_order'])) :
		$order_id = $_POST['order_id'];
		$username = $_POST['username'];
		
		$sql = "SELECT a.product_name as product_name, a.picture as picture, b.total_price as total_price, a.description as description, c.brand_name as brand FROM products a JOIN order_details b ON (a.id = b.product_id) JOIN brands c ON (a.brand_id = c.id) WHERE b.order_id = '$order_id'";
		$result = mysqli_query($connection, $sql);
		
?>
			<table class="table table-condensed view-order-table">
				<caption><?php echo $username; ?></caption>
				<thead>
					<tr>
						<th>Product Name</th>
						<th>Brand</th>
						<th>Description</th>
						<th>Price</th>
					</tr>
				</thead>
				<tbody>
					<?php while($row = mysqli_fetch_assoc($result)):
							extract($row); ?>
							<tr>
								<td><?php echo $product_name; ?></td>
								<td><?php echo $brand; ?></td>
								<td><?php echo $description; ?></td>
								<td><?php echo $total_price; ?></td>
							</tr>
					<?php endwhile; ?>
				</tbody>
			</table>

<?php endif; ?>
<?php 
	if (isset($_POST['rm_wish_item'])) {
		session_start();
		$product_id = $_POST['product_id'];
		unset($_SESSION['wish'][$product_id]);

		$sql = "DELETE FROM wishlists WHERE product_id = '$product_id'";
		mysqli_query($connection, $sql);

	}
 ?>
<?php 
	
	if (isset($_POST['user_order'])) :
		$order_id = $_POST['order_id'];

		$sql = "SELECT a.id as p_id, a.product_name as product_name, a.description as description, a.price as price, 
				d.brand_name as brand_name FROM
				products a JOIN order_details b ON (a.id = b.product_id) JOIN orders c ON (b.order_id = c.id ) JOIN brands d ON (a.brand_id = d.id) WHERE c.id = '$order_id'";
		$res = mysqli_query($connection, $sql); 
?>
			<table class="table table-condensed view-order-table">
				<caption>Order ID: <?php echo $order_id; ?></caption>
				<thead>
					<tr>
						<th>Product Name</th>
						<th>Brand</th>
						<th>Description</th>
						<th>Price</th>
					</tr>
				</thead>
				<tbody>
					<?php while($row = mysqli_fetch_assoc($res)):
						extract($row); 
						// $sql = "SELECT brand_name FROM brands WHERE id = 
						// 		(SELECT brand_id FROM products WHERE product_name = '$product_name')";
						// $brand_res = mysqli_query($connection, $sql);
						// $brand_row = mysqli_fetch_assoc($brand_res);
						// extract($brand_row);		
					?>
							<tr>
								<td><?php echo $product_name; ?></td>
								<td><?php echo $brand_name; ?></td> 
								<td><?php echo $description; ?></td>
								<td>Php <?php echo number_format($price,2); ?></td>
							</tr>
					<?php endwhile; ?>
					<?php 
						$sql = "SELECT SUM(a.price) as total_price FROM products a JOIN order_details b ON (a.id = b.product_id)
							JOIN orders c ON (b.order_id = c.id) WHERE c.id = '$order_id'";
							$res = mysqli_query($connection, $sql);
							$row = mysqli_fetch_assoc($res);
							extract($row);
					 ?>
							<tr>
								<td>Total: </td>
								<td></td>
								<td></td>
								<td>Php <?php echo number_format($total_price, 2); ?></td>
							</tr>
				</tbody>
			</table>
<?php endif; ?>
<?php 
	if (isset($_POST['checkout'])) {
		session_start();
		$username = $_SESSION['username'];
		$res = mysqli_query($connection, "SELECT id from orders WHERE user_id = 
							(SELECT id from users WHERE username = '$username') AND status = 'pending'");
		$row = extract(mysqli_fetch_assoc($res));
		$order_id = $id;

		$sql = "UPDATE orders SET status = 'done' WHERE id = '$order_id'";
		if (mysqli_query($connection, $sql) === TRUE) {
			unset($_SESSION['cart']);
			echo 'success';
		}
	}