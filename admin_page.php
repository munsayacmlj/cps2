<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin page</title>

	<style type="text/css" media="screen">

	</style>
	<?php require "assets/partials/head.php" ?>
</head>
<body>
	<!-- <div>
		<a href="index.php" class="btn btn-primary">Back to Homepage</a>
	</div> -->
<div class="container">
	<div class="row home-btn logout-btn">
		<div class="inner-home-btn col-12 col-md-4">
			<a href="index.php" class="btn btn-primary">Back to Homepage</a>
		</div>
		<div class="inner-admin-name col-12 col-md-4">
			<h2><?php echo $_SESSION['username']; ?></h2>
		</div>
		<div class="inner-logout-btn create-admin-btn col-12 col-md-4">
			<a href="logout.php" class="btn btn-info admin-logout">Logout</a>
			<span class="btn btn-link" data-toggle="modal" data-target="#adminModal">Create Admin Account</span>
		</div>
	</div>
	<div class="row">
		<!-- <div class="create-admin col-md-5">
			
		</div> -->


		<table class="table table-condensed col-md-auto users-table">
			<caption>List of Users</caption>
			<thead>
				<tr>
					<th>User ID</th>
					<th>First name</th>
					<th>Last name</th>
					<th>Username</th>
					<th>Role</th>
					<th colspan="2">Status</th>
				</tr>
			</thead>
			<tbody>
				<?php
					
					$admin = $_SESSION['username'];
					require "connection.php"; 
					$sql = "SELECT *, a.id as user_id, b.role_name as role, c.status as status FROM users a JOIN roles b ON (a.role_id = b.id) JOIN user_status c ON (a.status_id = c.id)";
					$result = mysqli_query($connection, $sql);
					while($row = mysqli_fetch_assoc($result)) : extract($row);
						if ($admin != $username) :
				 ?>
							<tr>
								<td><?php echo $user_id; ?></td>
								<td><?php echo $first_name; ?></td>
								<td><?php echo $last_name; ?></td>
								<td><?php echo $username; ?></td>
								<td><?php echo $role; ?></td>
								<td class="user-status">
									<?php echo $status; ?>
								</td>
								<?php if($status == 'ok') : ?>
								<td>
									<a href="#" class="btn btn-danger ban" data-index="<?php echo $user_id; ?>" data-toggle="modal" data-target="#myModal">Ban user</a>
								</td>
								<?php else: ?>
								<td>
									<a href="#" class="btn btn-success unban" data-index="<?php echo $user_id; ?>" data-toggle="modal" data-target="#myModal">Unban user</a>
								</td>
								<?php endif; ?>
							</tr>

				<?php 	endif;
					endwhile; ?>
			</tbody>
		</table>
		<div class="col-md-10">
			<table class="table table-condensed table-hover orders-table">
				<caption>List of orders</caption>
				<thead>
					<tr>
						<th>User ID</th>
						<th>User</th>
						<th>Order ID</th>
						<th>Date Ordered</th>
						<th>Quantity</th>
						<th colspan="3">Status</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						
						$sql = "SELECT b.id as order_id, a.id as user_id, a.username as username, b.order_date as date_ordered, 
								b.status as order_status, COUNT(quantity) as quantity
								FROM users a LEFT JOIN orders b ON (a.id = b.user_id) LEFT JOIN order_details c ON (b.id = c.order_id) WHERE a.role_id = 1 GROUP BY b.id";
						$result = mysqli_query($connection, $sql);
						while ($row = mysqli_fetch_assoc($result)): 
							extract($row);
					 ?>
						<tr class="view-orders" data-order-id = "<?php echo $order_id; ?>" data-username="<?php echo $username; ?>">
							<td><?php echo $user_id; ?></td>
							<td><?php echo $username; ?></td>
							<td><?php echo $order_id; ?></td>
							<td><?php echo $date_ordered; ?></td>
							<td><?php echo $quantity; ?></td>
							<td><?php echo $order_status; ?></td>
							<!-- <?php if ($order_status == 'done'): ?>
								<td><button class="btn btn-primary" disabled>Completed</button></td>
							<?php else: ?>
								<td><a href="#" class="btn btn-success order-complete-btn" data-user-id="<?php echo $user_id; ?>" data-order-id="<?php echo $order_id; ?>" data-toggle="modal" data-target="#myModal">Complete</a></td>
							<?php endif; ?>
							<td><a href="#" class="btn btn-danger order-delete-btn" data-username="<?php echo $username; ?>" data-order-id="<?php echo $order_id; ?>" data-quantity="<?php echo $quantity; ?>" data-toggle="modal" data-target="#myModal">Delete</a></td> -->
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>

		<div class="col-md-2">
			<table class="table table-condensed table-hover orders-table-btn">
					<tr>
						<th colspan="2">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						
						$sql = "SELECT b.id as order_id, a.id as user_id, a.username as username, b.order_date as date_ordered, 
								b.status as order_status, COUNT(quantity) as quantity
								FROM users a LEFT JOIN orders b ON (a.id = b.user_id) LEFT JOIN order_details c ON (b.id = c.order_id) WHERE a.role_id = 1 GROUP BY b.id";
						$result = mysqli_query($connection, $sql);
						while ($row = mysqli_fetch_assoc($result)): 
							extract($row);
					 ?>
					<tr>
							<?php if ($order_status == 'done'): ?>
								<td><button class="btn btn-sm" disabled>Completed</button></td>
								<td><button class="btn btn-sm" disabled>Disabled</button></td>
							<?php else: ?>
								<td>
									<a href="#" class="btn btn-success btn-sm order-complete-btn" data-user-id="<?php echo $user_id; ?>" data-order-id="<?php echo $order_id; ?>" data-toggle="modal" data-target="#myModal">Complete</a>
								</td>
								<td>
								<a href="#" class="btn btn-danger btn-sm order-delete-btn" data-username="<?php echo $username; ?>" data-order-id="<?php echo $order_id; ?>" data-quantity="<?php echo $quantity; ?>" data-toggle="modal" data-target="#myModal">Delete</a>
								</td>
							<?php endif; ?>
							
							<!-- <td>
								<a href="#" class="btn btn-danger btn-sm order-delete-btn" data-username="<?php echo $username; ?>" data-order-id="<?php echo $order_id; ?>" data-quantity="<?php echo $quantity; ?>" data-toggle="modal" data-target="#myModal">Delete</a>
							</td> -->
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div> <!-- /.row -->
</div>	<!-- /.container -->


	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body view-modal-body ban-unban-modal-body">
			        
			      </div>
			    </div>
		  </div>
	</div>


	<div class="modal fade" id="adminModal" tabindex="-1" role="dialog">
		  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="admin-modal-title" id="exampleModalLabel">Create Admin account</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        	<form action="admin_action.php" method="POST" accept-charset="utf-8">
			        		<div class="form-group">
			        			<label for="username">Username:</label>
			        			<input type="text" name="username" id="username" class="form-control" autocomplete="new-password">
			        		</div>
			        		<div class="form-group">
			        			<label for="password">Password:</label>
			        			<input type="password" name="password" id="password" class="form-control" autocomplete="new-password">
			        		</div>
			        		<button type="submit" class="btn btn-primary" name="admin_register">Create admin account</button>
			        	</form>
			      </div>
			    </div>
		  </div>
	</div>
</body>

	<script src="assets/js/alertify.js" type="text/javascript"></script>
	<script>
		$('.view-orders').click(function() {
			var order_id = $(this).data('order-id');
			var username = $(this).data('username');
			$.ajax({
				url: 'endpoint.php',
				type: 'POST',
				data: {
					view_order : true,
					order_id : order_id,
					username : username 
				},
				success:function(data) {
					$('.modal-title').html("View Orders");
					$('.view-modal-body').html(data);
					$('#myModal').modal('show');
				}
			});
		});

		$('.ban').click(function() {
			var id = $(this).data('index');

			$.ajax({
				url: 'endpoint.php',
				type: 'POST',
				data: {
					ban : true,
					id : id
				},
				success:function(data) {
					$('.modal-title').html("BAN USER");
					$('.ban-unban-modal-body').html(data);
				}
			});
		});

		$('.unban').click(function() {
			var id = $(this).data('index');
			
			$.ajax({
				url: 'endpoint.php',
				type: 'POST',
				data: {
					unban: true,
					id : id
					
				},
				success:function(data) {
					$('.modal-title').html("UNBAN USER");
					$('.ban-unban-modal-body').html(data);
				}
			});
		});

		$('.order-complete-btn').click(function() {
			var order_id = $(this).data('order-id');
			var user_id = $(this).data('user-id');
			$.ajax({
				url: 'endpoint.php',
				type: 'POST',
				data: {
					order_complete: true,
					order_id : order_id,
					user_id : user_id
				},
				success:function(data) {
					$('.modal-title').html("COMPLETE ORDER");
					$('.ban-unban-modal-body').html(data);
				}
			});
		});

		$('.order-delete-btn').click(function() {
			var order_id = $(this).data('order-id');
			var username = $(this).data('username');
			var quantity = $(this).data('quantity');
			$.ajax({
				url: 'endpoint.php',
				type: 'POST',
				data: {
					order_delete: true,
					order_id : order_id,
					username: username,
					quantity: quantity
				},
				success:function(data) {
					$('.modal-title').html("DELETE ORDER");
					$('.ban-unban-modal-body').html(data);
				}
			});
		});
	</script>

</html>