<?php
    require_once 'inc/header.php'
?>

<?php
    require_once 'inc/nav.php';

	$product_id = '';
	if(isset($_GET['product_id']))
	{
		$product_id = $_GET['product_id'];
	}
	$products = get_products('',$product_id);
	$result = mysqli_fetch_assoc($products);

?>

<?php 

	$products = get_products('');

	if(isset($_POST['add_to_cart']))
	{
		// Check if user is logged in
		if (!isset($_SESSION["user_id"])) {
			header("Location: login.php");
		}

		$product_id = $_POST['product_id'];
		$product_name = $_POST['product_name'];
		$unit_price = $_POST['unit_price'];
		$product_image = $_POST['product_image'];

		// Get user_id from session
		$user_id = $_SESSION["user_id"];

		//select cart data based on condition
		$sql = "select * from cart WHERE product_id='$product_id' AND user_id='$user_id'";
		$statement = mysqli_query($con,$sql);
		if(mysqli_num_rows($statement) > 0)
		{
			$display_message[] = "product already added to cart";
		}
		else{
			//insert into cart table
			$query = "INSERT INTO cart(product_id,user_id,product_name,unit_price,quantity,image) VALUES ('$product_id',$user_id,'$product_name','$unit_price', '1', '$product_image')";
			$result = mysqli_query($con,$query);
			$display_message[] = "product added to cart";
		}

	}

?>



	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Product PAge</h4>
			<div class="site-pagination">
				<a href="">Home</a> /
				<a href="">Shop</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->

	<!-- product section -->
	<section class="product-section">
		<div class="container">
			<div class="back-link">
				<a href="./category.php"> &lt;&lt; Back to Category</a>
			</div>

			<form method="POST" action="">
				
				<div class="row">
					<div class="col-lg-6">
						<div class="product-pic-zoom">
							<img class="product-big-img" src="admin/img/<?php echo $result['image'] ?>" alt="">
						</div>
					</div>
					<div class="col-lg-6 product-details">
						<h2 class="p-title"><?php echo $result['product_name'] ?></h2>
						<h3 class="p-price"><span>Price : </span>$<?php echo $result['price'] ?></h3>
						<!--<h4 class="p-stock">Available: <span>In Stock</span></h4>-->
						<h4 class="p-stock">Available:
							<?php
								$stock_quantity = $result['stock_quantity'];
								if ($stock_quantity <= 0) {
								echo "<span>Out of Stock</span>";
								} else {
								echo "<span>In Stock</span>";
								}
							?>
						</h4>
						<div class="p-rating">
							<i class="fa fa-star-o"></i>
							<i class="fa fa-star-o"></i>
							<i class="fa fa-star-o"></i>
							<i class="fa fa-star-o"></i>
							<i class="fa fa-star-o fa-fade"></i>
						</div>
						<div class="p-review">
							<h3></h3>
						</div>
						<input type="hidden" name="product_id" value="<?php echo $result['product_id']?>">
						<input type="hidden" name="product_name" value="<?php echo $result['product_name']?>">
						<input type="hidden" name="unit_price" value="<?php echo $result['price'] ?>">
						<input type="hidden" name="product_image" value="<?php echo $result['image'] ?>">
						<button type="submit" value="Add to Cart" class="site-btn" name="add_to_cart">Add to Cart</button>
						<?php
							if(isset($display_message))
							{
								foreach($display_message as $display_message){
									echo "<span>$display_message</span>";
								}
							}
						?>
						<div id="accordion" class="accordion-area">
							<div class="panel">
								<div class="panel-header" id="headingOne">
									<button class="panel-link active" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">information</button>
								</div>
								<div id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
									<div class="panel-body">
										<p><?php echo $result['description'] ?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<form>
		</div>
	</section>
	<!-- product section end -->


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

