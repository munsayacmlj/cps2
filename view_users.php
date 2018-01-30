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

		$results_per_page = 5;

		$sql = "SELECT *, a.id as user_id, b.role_name as role, c.status as status FROM users a JOIN roles b ON (a.role_id = b.id) JOIN user_status c ON (a.status_id = c.id) WHERE NOT (a.username = '$admin')";
		$res = mysqli_query($connection, $sql);
		$num_of_rows = mysqli_num_rows($res);

		$num_of_pages = ceil($num_of_rows / $results_per_page);
		if (isset($_GET['user_page'])) 
			$page = $_GET['user_page'];
		else
			$page = 1;


		$this_page_result = ($page - 1) * $results_per_page;


					$sql = "SELECT *, a.id as user_id, b.role_name as role, c.status as status FROM users a JOIN roles b ON (a.role_id = b.id) JOIN user_status c ON (a.status_id = c.id) WHERE NOT (a.username = '$admin') LIMIT " . $this_page_result . ',' . $results_per_page;
					$result = mysqli_query($connection, $sql);
					while($row = mysqli_fetch_assoc($result)) : 
					extract($row);
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

				<?php endwhile; ?>
			</tbody>
		</table>
		<div class="page-btns-container" id="pageDiv">
			<?php for ($page=1; $page <= $num_of_pages; $page++) : ?>
					<span>
						<a class="page-btn" id="p_<?php echo $page; ?>" href="admin_page.php?admin=<?php echo $admin; ?>&user_page=<?php echo $page; ?>"><?php echo $page; ?></a>
					</span>
			<?php endfor;?>
		</div>

		<?php 
			if (isset($_GET['user_page'])) {
				echo '<script type="text/javascript">
			    $(document).ready(function(){';

			    $from_url = $_GET['user_page'];

			    echo '
			    $(\'#p_' . $from_url . '\').addClass(\'active\');
			        });
			    </script>';
		    }
		?>