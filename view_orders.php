
		<div class="col-md-9">
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
		$admin = $_SESSION['username'];
		/* for pagination */
		$results_per_page = 5;

		$sql = "SELECT b.id as order_id, a.id as user_id, a.username as username, b.order_date as date_ordered, 
								b.status as order_status, COUNT(quantity) as quantity
								FROM users a LEFT JOIN orders b ON (a.id = b.user_id) LEFT JOIN order_details c ON (b.id = c.order_id) WHERE a.role_id = 1 GROUP BY b.id";
		$res = mysqli_query($connection, $sql);
		$num_of_rows = mysqli_num_rows($res);

		$num_of_pages = ceil($num_of_rows / $results_per_page);
		if (isset($_GET['order_page'])) 
			$page = $_GET['order_page'];
		else
			$page = 1;


		$this_page_result = ($page - 1) * $results_per_page;
						
						$sql = "SELECT b.id as order_id, a.id as user_id, a.username as username, b.order_date as date_ordered, 
								b.status as order_status, COUNT(quantity) as quantity
								FROM users a LEFT JOIN orders b ON (a.id = b.user_id) LEFT JOIN order_details c ON (b.id = c.order_id) WHERE a.role_id = 1 GROUP BY b.id LIMIT "
									 . $this_page_result . ',' . $results_per_page;
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
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>

		<div class="col-md-3">
			<table class="table table-condensed table-hover orders-table-btn">
					<tr>
						<th colspan="2">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						
						$sql = "SELECT b.id as order_id, a.id as user_id, a.username as username, b.order_date as date_ordered, 
								b.status as order_status, COUNT(quantity) as quantity
								FROM users a LEFT JOIN orders b ON (a.id = b.user_id) LEFT JOIN order_details c ON (b.id = c.order_id) WHERE a.role_id = 1 GROUP BY b.id LIMIT " . $this_page_result . ',' . $results_per_page;
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
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div> <!-- /.col-md-2 -->
		<div class="page-btns-container" id="pageDiv">
			<?php for ($page=1; $page <= $num_of_pages; $page++) : ?>
					<span>
						<a class="page-btn" id="p_<?php echo $page; ?>" href="admin_page.php?admin=<?php echo $admin; ?>&order_page=<?php echo $page; ?>"><?php echo $page; ?></a>
					</span>
			<?php endfor;?>
		</div>

<?php 
	if (isset($_GET['order_page'])) {
		echo '<script type="text/javascript">
	    $(document).ready(function(){';

	    $from_url = $_GET['order_page'];

	    echo '
	    $(\'#p_' . $from_url . '\').addClass(\'active\');
	        });
	    </script>';
    }
?>