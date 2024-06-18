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

	$products = get_products(''); 


	// Get user_id from session
	$user_id = $_SESSION["user_id"];
	$cart = view_cart($user_id);

	//update cart quantity
	if(isset($_POST['update_product_quantity']))
	{
		$update_value = $_POST['update_quantity']; 
		$update_id = $_POST['update_quantity_id'];

		$update_quantity_query = mysqli_query($con,"update cart set quantity='$update_value' where cart_id='$update_id'") or die(mysqli_error($con));
		if($update_quantity_query)
		{
			header('location:cart.php');
		}
	}

	//Initialize grand total to 0
	$grand_total = 0;

?>


	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Your cart</h4>
			<div class="site-pagination">
				<a href="">Home</a> /
				<a href="">Your cart</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->


	<!-- cart section end -->
	<section class="cart-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="cart-table">
						<h3>Your Cart</h3>
						<div class="cart-table-warp">
							<table>
							<thead>
								<tr>
									<th class="product-th" style="text-align: center;">Product Image</th>
									<th class="size-th" style="text-align: center;">Product Name</th>
									<th class="total-th" style="text-align: center;">Unit Price</th>
									<th class="quy-th" style="text-align: center;">Quantity</th>
									<th class="total-th" style="text-align: center;">Total Amount</th>
									<th class="size-th" style="text-align: center;">Remove</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<?php
										while($row=mysqli_fetch_assoc($cart))
										{
											?>
											<td style="text-align: center;"><img src="admin/img/<?php echo $row['image'] ?>" width="50px" height="50px" class="img-circle"></td>
											<td style="text-align: center;"><?php echo $row['product_name']; ?></td>
											<td style="text-align: center;">$<?php echo number_format($row['unit_price']); ?></td>
											<form method="POST">
												<td class="quy-col"style="text-align: center;">
													<div class="quantity">
													    <input type="hidden" value="<?php echo $row['cart_id']; ?>" name="update_quantity_id">
														<div class=" ">
															<input type="number" value="<?php echo $row['quantity'] ?>" name="update_quantity" style="width: 60px; height: 30px; border-radius: 15px; border: 1px solid #ccc; padding: 5px 10px; font-size: 14px;">
															<input type="submit" class="update_quantity" value="+" name="update_product_quantity" style="border-radius: 50%; padding: 8px 16px;">
														</div>
													</div>
												</td>
												<td style="text-align: center;">$<?php echo $sub_total = number_format($row['unit_price'] * $row['quantity']); ?></td>
											</form>
											<td class="text-center" style="text-align: center;">
												<a href="del_cart.php?cart_id=<?php echo $row['cart_id'] ?>" class="btn" style="background-color: transparent; padding: 5px 10px; border-radius: 50%;"><i class="fas fa-trash" style="font-size: 14px;"></i></a>
											</td>
								</tr>
									<?php
					                        //Update Grand Total
											$grand_total += $row['unit_price'] * $row['quantity'];
										}
									?>
							</tbody>
						</table>
						</div>
						<div class="total-cost">
							<h6>Grand Total <span>$<?php echo number_format($grand_total); ?></span></h6>
						</div>
					</div>
				</div>
				<div class="col-lg-4 card-right">
					<a href="clear_cart.php?delete_all" class="site-btn">Clear Cart</a>
					<a href="checkout.php" class="site-btn">Proceed to checkout</a>
					<a href="product.php" class="site-btn sb-dark">Continue shopping</a>
				</div>
			</div>
		</div>
	</section>
	<!-- cart section end -->

	<!-- RELATED PRODUCTS section -->
	<section class="related-product-section">
		<div class="container">
			<div class="section-title">
				<h2>RELATED PRODUCTS</h2>
			</div>
			<div class="product-slider owl-carousel">

				<?php
				
					while($row = mysqli_fetch_assoc($products))
					{

						?>
				
						<div class="product-item">
							<div class="pi-pic">
								<a href="product.php?product_id=<?php echo $row['product_id']?>"><img src="admin/img/<?php echo $row['image'] ?>"></a>
							</div>
							<div class="pi-text">
								<a href="product.php?product_id=<?php $row['product_id']?>"><h6>$<?php echo $row['price'] ?></h6></a>
								<a href="product.php?product_id=<?php $row['product_id']?>"><p><?php echo $row['product_name'] ?></p></a>
							</div>
						</div>

					<?php

					}

					?>
			</div>
		</div>
	</section>
	<!-- related product section end -->

<?php
    require_once 'inc/footer.php'
?>
