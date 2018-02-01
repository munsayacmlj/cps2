<!DOCTYPE html>
<html>
<head>
	<title>MLJM SHOP / Admin</title>

	<style type="text/css" media="screen">

	</style>
	<?php require "assets/partials/head.php" ?>
	<?php require "assets/partials/top-nav.php" ?>
	<?php require "assets/partials/navigation.php" ?>
</head>
<body>
<?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin'): ?>
		
<div class="container">
	<div class="row">
		<div class="row col-12 pt-4 pb-4"">
			<h2 style="text-align: center;">Welcome, <?php echo $_SESSION['username']; ?></h2>
		</div>
		<div>
			<a href="admin_page.php?admin=<?php echo $_SESSION['username']; ?>&user_page=1" class="btn">
				<span class="btn admin-btn" id="viewUsersTable">View Users</span>
			</a>
			<a href="admin_page.php?admin=<?php echo $_SESSION['username']; ?>&order_page=1" class="btn">
				<span class="btn admin-btn" id="viewOrdersTable">View Orders</span>
			</a>
			<!-- <button type="button" class="btn" id="viewUsersTable">View Users</button> -->
		</div>
	</div>
</div>

<div class="container" id="adminOuter">
	<div class="row" id="adminContent">
		<?php 
				require "connection.php";
				if (isset($_GET['user_page'])) :
					require "view_users.php";
				
				elseif (isset($_GET['order_page'])) :
					require "view_orders.php";
				
				else :				
		?>
				<p>You can view the list of users and their orders.</p>
	<?php endif; ?>
	</div>
</div>
<?php else: ?>
	<h2>You have no permission to visit this page.</h2>
<?php endif ?>	

	<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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


	<div class="modal" id="adminModal" tabindex="-1" role="dialog">
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
	<?php 
		if (isset($_GET['user_page'])) {
			echo '<script type="text/javascript">
		    $(document).ready(function(){';
		    echo '
		    $(\'#viewUsersTable\').addClass(\'active1\');
		        });
		    </script>';
	    }

	    if (isset($_GET['order_page'])) {
			echo '<script type="text/javascript">
		    $(document).ready(function(){';
		    echo '
		    $(\'#viewOrdersTable\').addClass(\'active1\');
		        });
		    </script>';
	    }

	?>
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