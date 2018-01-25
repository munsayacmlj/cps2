<?php 
	
	require "connection.php";

	if (isset($_POST['register'])) { /* register account endpoint */
		
		$first_name = $_POST['firstname'];
		$last_name = $_POST['lastname'];
		$username = $_POST['reg-username'];
		$password = sha1($_POST['reg-password']);

		$sql = "INSERT INTO users (first_name, last_name, username, password, role_id)
				VALUES ('$first_name', '$last_name', '$username', '$password', 1)";
		mysqli_query($connection, $sql);

		header('location: login.php');
		exit;
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
			
			
			$sql = "SELECT COUNT(quantity) as qty FROM order_details WHERE product_id = '$extracted_product_id'";
			$result = mysqli_query($connection, $sql);
			$row = mysqli_fetch_assoc($result);
			extract($row);
			if($qty >= 5){
					$new_loc = (string)$_SERVER['HTTP_REFERER'];			
					echo "<script>alert('You cannot order the same item more than 5 times.');
							window.location.replace(\"$new_loc\")</script>";
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
			mysqli_query($connection, $sql);

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
			
			
			$sql = "SELECT COUNT(quantity) as qty FROM order_details WHERE product_id = '$extracted_product_id'";
			$result = mysqli_query($connection, $sql);
			$row = mysqli_fetch_assoc($result);
			extract($row);
			if($qty >= 5){
					$new_loc = (string)$_SERVER['HTTP_REFERER'];			
					echo "<script>alert('You cannot order the same item more than 5 times.');
							window.location.replace(\"$new_loc\")</script>";
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
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	if (isset($_POST['qtyChange'])) {   /* CHANGE ITEM'S QUANTITY*/
		session_start();
		$product_id = $_POST['id']; /*product_id*/
		$quantity = $_POST['qty'];
		// echo $product_id."    ".$quantity;

		$sql = "SELECT COUNT(quantity) as db_qty FROM order_details WHERE product_id = '$product_id'";
		$result = mysqli_query($connection, $sql);
		$row = mysqli_fetch_assoc($result);
		extract($row);
		if ($quantity < $db_qty) {
			// echo $quantity;
			// echo $db_qty;
			while ($quantity < $db_qty) {
				$sql = "DELETE FROM order_details WHERE product_id = '$product_id' LIMIT 1";
				mysqli_query($connection, $sql);

				$_SESSION['cart'][$product_id] -= 1;

				$sql = "SELECT COUNT(quantity) as db_qty FROM order_details WHERE product_id = '$product_id'";
				$result = mysqli_query($connection, $sql);
				$row = mysqli_fetch_assoc($result);
				extract($row);
			}
			// echo $db_qty;
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
		}
		
	}

	if (isset($_GET['delete_item_from_cart'])) {
		session_start();
		$id = $_GET['id'];
		unset($_SESSION['cart'][$id]);

		$sql = "DELETE FROM order_details WHERE product_id = '$id'";
		mysqli_query($connection, $sql);
		header('location: '. $_SERVER['HTTP_REFERER']);
		exit;
	}


	if (isset($_POST['edit_item'])) :
		$id = $_POST['index'];
		$sql = "SELECT * FROM products WHERE id = '$id'";
		$result = mysqli_query($connection, $sql);
		$product_row = mysqli_fetch_assoc($result);
		extract($product_row);

		$sql = "SELECT brand_name FROM brands a JOIN products b ON (a.id = b.brand_id)
					WHERE b.id = '$id'";
		$result = mysqli_query($connection, $sql);
		$brand_row = mysqli_fetch_assoc($result);
		extract($brand_row);
?>

	<div class="brand-name-edit-modal">
		<h3><?php echo $brand_name; ?></h3>
	</div>
	<form id="modal-form" action="admin_action.php?edit_action=true&id=<?php echo $id; ?>" method="POST" class="edit-form">
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

<?php endif; ?>

<?php 
	
	if (isset($_POST['add_item'])) :

?>	
	<div class="container add-item-modal">
		<div class="row">
		        <form class="form-group col-12" action="admin_action.php?add_item=true" method="post" enctype="multipart/form-data">
					<div class="input-desc form-group col-12">
						<label for="product_name">Name</label>
						<input class="form-control" type="text" id="product_name" name="product_name">
					</div>
					
					<div class="form-group col-12">
			            <label for="description">Description</label>
			            <textarea class="form-control" id="description" name="description"></textarea>
					</div>

					<div class="form-group col-12">
			            <label for="price">Price</label>
			            <input class="form-control" type="number" name="price" id="price" min=0>
					</div>

					<div class="form-group col-12">
			            <label for="image">Image</label>
						<input class="form-control" type="file" name="image" id="image">
					</div>

					<div class="form-inline">
			            <select class="form-control selectables" name="brand">
			                <option disabled>Brand Name</option>
			                <?php 
			                $sql = "SELECT * FROM brands";
			                $result = mysqli_query($connection, $sql);
			                while($row = mysqli_fetch_assoc($result)) :
			                    extract($row);
			                 ?>
			                    <option value="<?php echo $id ?>"><?php echo $brand_name ?></option>
			                <?php endwhile; ?>
			            </select>


			            <select class="form-control selectables" name="gender">
			                <option disabled>Men/Women</option>
			                <?php 
			                $sql = "SELECT * FROM genders";
			                $result = mysqli_query($connection, $sql);
			                while($row = mysqli_fetch_assoc($result)) :
			                    extract($row);
			                 ?>
			                    <option value="<?php echo $id ?>"><?php echo $gender; ?></option>
			                <?php endwhile; ?>
			            </select>

			            <select class="form-control selectables" name="product_type">
			                <option disabled>Type</option>
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