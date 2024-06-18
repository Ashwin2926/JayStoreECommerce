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
	
	$grand_total = 0;

	$sql = "select *, (unit_price * quantity) AS total_amount from cart WHERE user_id = '$user_id'";
	$cart_items = mysqli_query($con, $sql);

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


	<!-- checkout section  -->
	<section class="checkout-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 order-2 order-lg-1">
					<form class="checkout-form" method="POST">
						<div class="cf-title">Billing and Shipping Information</div>
						<div class="row">
							<div class="col-md-7">
								<p>*Enter Your Details Below*</p>
							</div>
						</div>
						<div class="row address-inputs">
							<div class="col-md-12">
								<input type="text" placeholder="Enter Full Name" name="name">
								<input type="text" placeholder="Enter E-Mail" name="email">
								<input type="text" placeholder="Enter Mobile Number" name="phone">
								<input type="text" placeholder="Street Address" name="address">
							</div>
							<div class="col-md-6">
								<input type="text" placeholder="State" name="state">
							</div>
							<div class="col-md-6">
								<input type="text" placeholder="Zipcode" name="zipcode">
							</div>
						</div>
						<button type="submit" class="site-btn submit-order-btn" name="place_order">Place Order</button>
					</form>
				</div>
				<div class="col-lg-4 order-1 order-lg-2">
					<div class="checkout-cart">
						<h3>Your Cart</h3>
					<?php
						while($row=mysqli_fetch_assoc($cart_items))
						{

					?>

							<ul class="product-list">
								<li>
									<div class="pl-thumb"><img src="admin/img/<?php echo $row['image'] ?>"></div>
									<h6><?php echo $row['product_name'] ?> * <?php echo $row['quantity'] ?></h6>
									<p>$<?php echo $row['total_amount'] ?></p>
								</li>
							</ul>
					<?php

							//Update Grand Total
							$grand_total += $row['total_amount'];

						}

						if(isset($_POST['place_order']))
						{
							$name = $_POST['name'];
							$email = $_POST['email'];
							$phone = $_POST['phone'];
							$address = $_POST['address'];
							$state = $_POST['state'];
							$zipcode = $_POST['zipcode'];

							
							// Insert a new row into the orders table
							$query1 = "INSERT INTO orders (user_id, total_price,status,name,email,phone,address,state,zipcode) VALUES ('$user_id', '$grand_total', 0,'$name','$email','$phone','$address','$state','$zipcode')";
							$result = mysqli_query($con,$query1);

							//Retrieve the order id of the newly inserted record in the orders table:
							$order_id = mysqli_insert_id($con);

							//Insert a new record in the order_item table for each cart item, using the order id 
							$query2 = "SELECT * FROM cart WHERE user_id='" . $_SESSION['user_id'] . "'";
							$cart_items = mysqli_query($con,$query2);
							while ($cart_item = mysqli_fetch_assoc($cart_items)) {
								$query3 = "INSERT INTO order_items (order_id, product_id, product_name, unit_price, quantity)
										VALUES ('" . $order_id . "', '" . $cart_item['product_id'] . "', '" . $cart_item['product_name'] . "',
										'" . $cart_item['unit_price'] . "', '" . $cart_item['quantity'] . "')";
								mysqli_query($con,$query3);

								// Update the stock quantity in the products table
								$query4 = "UPDATE products
										   SET stock_quantity = stock_quantity - '" . $cart_item['quantity'] . "'
								           WHERE product_id = '" . $cart_item['product_id'] . "'";
								mysqli_query($con, $query4);

							}


							// Delete items from cart table
							$query = "DELETE FROM cart WHERE user_id = '{$_SESSION['user_id']}'";
							$result = mysqli_query($con, $query);

							// Redirect to order confirmation page with order details
							header('location: order_receipt.php');

						}

					?>
							<ul class="price-list">
								<li>Total<span>$<?php echo number_format($grand_total) ?></span></li>
								<li>Shipping<span>free</span></li>
								<li class="total">Total<span>$<?php echo number_format($grand_total) ?></span></li>
							</ul>

					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- checkout section end -->

<?php
    require_once 'inc/footer.php'
?>

	