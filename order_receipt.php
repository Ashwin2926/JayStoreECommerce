<?php require_once 'inc/header.php'; ?>

<head>
  <title>Order Confirmation</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
    }
    .container {
      max-width: 800px;
      margin: 50px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    h1 {
      font-size: 1rem;
      margin-top: 0;
      margin-bottom: 20px;
      text-align: center;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th,
    td {
      padding: 10px;
      border-bottom: 1px solid #ddd;
    }
    th {
      text-align: left;
      font-weight: bold;
    }
    .total {
      font-size: 1.2rem;
      font-weight: bold;
      text-align: right;
      padding-right: 20px;
    }
    .button {
      display: block;
      width: 200px;
      height: 50px;
      margin: 20px auto;
      background-color: #03dffc;
      color: #fff;
      border: none;
      border-radius: 5px;
      text-align: center;
      line-height: 50px;
      text-decoration: none;
      font-weight: bold;
      cursor: pointer;
    }
    .button:hover {
      background-color: white;
    }
  </style>
</head>


<?php

  // Check if user is logged in
  if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
  }

  // Get user_id from session
  $user_id = $_SESSION['user_id'];


	// Get order details from the URL parameter
  $sql = "SELECT o.order_id, 
          o.name,
          o.email,
          o.phone,
          o.address,
          o.state,
          o.zipcode,
          GROUP_CONCAT(oi.product_name SEPARATOR ',') AS product_names, 
          GROUP_CONCAT(oi.unit_price SEPARATOR ',') AS unit_prices, 
          GROUP_CONCAT(oi.quantity SEPARATOR ',') AS quantities, 
          o.total_price
          FROM orders o 
          JOIN order_items oi ON o.order_id = oi.order_id 
          WHERE o.user_id = '$user_id' 
          GROUP BY o.order_id 
          ORDER BY o.created_at DESC 
          LIMIT 1";
  $order = mysqli_query($con, $sql);
	$result = mysqli_fetch_assoc($order);

?>


<body>
<section class="contact-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 contact-info">
				<h3>Thank you for Shopping</h3>
				<h1>Your order has been placed sucessfully!!</h1>
				<p>Order ID: <?php echo $result['order_id'] ?></p>
				<p>Full Name : <?php echo $result['name'] ?></p>
				<p>Email : <?php echo $result['email'] ?></p>
        <p>Phone : <?php echo $result['phone'] ?></p>
				<p>Address : <?php echo $result['address'] ?></p>
				<p>State : <?php echo $result['state'] ?></p>
				<p>Zipcode : <?php echo $result['zipcode'] ?></p>
			</div>
			
			<table>
			<thead>
				<tr>
				<th>Products</th>
				<th>Quantity</th>
        <th>Unit Price</th>
				<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<!-- Add order details here -->
				<tr>
					<td><?php
						$result['product_names'] = str_replace(',', '<br>', $result['product_names']);
						$result['product_names'] = str_replace(array('(', ')'), '', $result['product_names']);
						$result['product_names'] = preg_replace('/(\d+)/', ' $1', $result['product_names']);
						echo $result['product_names'];
						?>
					</td>
          <td><?php echo str_replace(',', '<br>', $result['quantities']); ?></td>
					<td><?php echo str_replace(',', '<br>', $result['unit_prices']); ?></td>
					<td><?php echo $result['total_price']; ?></td>
				</tr>
			</tbody>
			</table>
			<p>
			<a class="button" href="order_history.php">View Order History</a>
			<a class="button" href="index.php">Continue Shopping</a>
			</p>
		</div>
	</div>
</section>
</body>

	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.slicknav.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.nicescroll.min.js"></script>
	<script src="js/jquery.zoom.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/main.js"></script>

	</body>
</html>
