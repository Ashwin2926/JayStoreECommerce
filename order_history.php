<?php
    require_once 'inc/header.php'
?>

<?php
    require_once 'inc/nav.php'
?>

<?php 

	// Check if user is logged in
	if (!isset($_SESSION["user_id"])) {
		header("Location: login.php");
	}

	// Get user_id from session
	$user_id = $_SESSION['user_id'];
	
	$sql = "SELECT o.order_id, 
			GROUP_CONCAT(oi.product_id SEPARATOR ',') AS product_ids,
            GROUP_CONCAT(oi.product_name SEPARATOR ',') AS product_names,
            GROUP_CONCAT(oi.unit_price SEPARATOR ',') AS unit_prices,
            GROUP_CONCAT(oi.quantity SEPARATOR ',') AS quantities,
			o.total_price,
			o.created_at,
			o.status
			FROM orders o
			JOIN order_items oi ON o.order_id = oi.order_id
			WHERE o.user_id = '$user_id'
			GROUP BY o.order_id
			ORDER BY o.created_at DESC";
    $result = mysqli_query($con, $sql);

?>


	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Order History</h4>
			<div class="site-pagination">
				<a href="">Home</a> /
				<a href="">Your Orders</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->

	<section class="cart-section spad">
		<div class="container">
			<h3>Your Orders</h3>
			<table class="table">
			<thead>
				<tr>
				<th scope="col">Order #</th>
				<th scope="col">Order Date</th>
				<th scope="col">Products</th>
				<th scope="col">Quantity</th>
				<th scope="col">Unit Price</th>
				<th scope="col">Total Amount</th>
				<th scope="col">Status</th>
				</tr>
			</thead>
			<tbody>
					<tr>
				<?php					
					while($row=mysqli_fetch_assoc($result))
					{
				?>
						<th scope="row"><?php echo $row['order_id']; ?></th>
						<td><?php echo $row['created_at']; ?></td>
						<td><?php echo str_replace(',', '<br>', $row['product_names']); ?></td>
						<td><?php echo str_replace(',', '<br>', $row['quantities']); ?></td>
						<td><?php echo str_replace(',', '<br>', $row['unit_prices']); ?></td>
						<td>$<?php echo number_format($row['total_price']); ?></td>
						<td>
							<?php 
								if($row['status']=='1')
								{
									echo "Processed"; 
								}
								else
								{
									echo "Pending"; 
								}
							?>
						</td>
					</tr>
				<?php
					}
				?> 

			</tbody>
			</table>
		</div>
	</section>

<?php
    require_once 'inc/footer.php'
?>
