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
	
	
	<div class="container account-wrapper">
		<div class="account-page-title">
			<span class="acc">Account</span>
		</div>

		<div class=" mb-3">
			<input type="button" name="change-password-btn" id="change-password-btn" class="btn btn-info" value="Change Password">
		</div>
		<form action="" method="POST" class="form-group" id="change-password-form" style="width: 20%;">
			<div class="form-group">
				<label for="old-password">Old password:</label>
				<input type="text" name="old-password" class="form-control">
			</div>
			<div class="form-group">
				<label for="new-password1">New password:</label>
				<input type="text" name="new-password1" class="form-control">
			</div>
			<div class="form-group">
				<label for="new-password2">Re-type new password:</label>
				<input type="text" name="new-password2" class="form-control">
			</div>
			<div class="form-inline">
				<input type="submit" name="submit-password" class="btn btn-success">
			</div>
		</form>
	
		<div class="row">
			
		<table class="table table-condensed table-hover col-md-auto user-order-table">
			<caption>Transaction History</caption>
			<thead>
				<tr>
					<th>Order ID</th>
					<th>Date Ordered</th>
					<th>Quantity</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					require "connection.php";
					$username = $_SESSION['username'];
					$sql = "SELECT c.id as order_id, c.order_date as date_ordered, c.status as order_status, COUNT(quantity) as quantity FROM products a JOIN order_details b ON (a.id = b.product_id)
							JOIN orders c ON (b.order_id = c.id) WHERE c.user_id = (SELECT id FROM users WHERE username = '$username') AND c.status = 'done' GROUP BY order_id ORDER BY c.status";
					$res = mysqli_query($connection, $sql);
					while ($row = mysqli_fetch_assoc($res)) : 
							extract($row);
					?>
					<tr id="<?php echo $order_id; ?>" data-index="<?php echo $order_id; ?>" class="order-row">
						<td><?php echo $order_id; ?></td>
						<td><?php echo $date_ordered; ?></td>
						<td><?php echo $quantity; ?></td>
						<td><?php echo $order_status; ?></td>

					</tr>
			  <?php endwhile; ?>
			</tbody>
		</table>
		</div> <!-- /.row -->
		<div class="danger-zone pt-5 mt-5">
			<div class="danger-button pt-5 mt-5">
				<input type="button" id="delete-account" class="btn btn-danger" value="Delete Account">
			</div>
		</div>
	</div> <!-- /.container -->

	<div class="modal" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="user-modal-body">
			        
			      </div>
			    </div>
		  </div>
	</div>

	<script src="assets/js/main.js" type="text/javascript"></script>
	<script src="assets/js/uglipop.js" type="text/javascript"></script>
    <script type="text/javascript">
    	$('.order-row').click(function() {
    		var order_id = $(this).data('index');
    		
    		$.ajax({
    			url: 'endpoint.php',
    			type: 'POST',
    			data: {
    				user_order: true,
    				order_id : order_id
    			},
    			success:function(data) {
    				$('.user-modal-body').html(data);
    				$('#userModal').modal('show');
    			}
    		});
    	});

    	$('#delete-account').click(function() {
    		$.ajax({
    			url: 'endpoint.php',
    			type: 'POST',
    			data: {
    				delete_account : true
    			},
    			success:function(data) {
    				$('.modal-title').html("Delete Account");
    				$('.user-modal-body').html(data);
    				$('#userModal').modal('show');
    			}
    		});
    	});

    	$('#change-password-btn').click(function() {
    		// $('#change-password-form').show();
    		var x = document.getElementById('change-password-form');
    		if (x.style.display = 'none' ) {
    			x.style.display = "block";
    		}
    		else
    			x.style.display = "none";
    	});
    </script>
</body>
</html>