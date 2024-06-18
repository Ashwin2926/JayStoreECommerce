<?php require_once 'inc/header.php'; ?>

<?php require_once 'inc/nav.php'; ?>

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
			header("location:index.php");
		}

	}

?>


<body>

	<!-- Hero section -->
	<section class="hero-section">
		<div class="hero-slider owl-carousel">
			<div class="hs-item set-bg" data-setbg="./assets/img/slider1.jpg" >
				<div class="container">
					<div class="row">
						<div class="col-xl-6 col-lg-7" style="color: #39B1A1;">
						<h1  style="color: #0077b6;">JayStore</h1>
							<p  style="color: #fff; font-weight: bold; ">At JayStore, we are committed to delivering products that meet the highest standards of quality, ensuring our customers receive durable and well-crafted apparel that they can enjoy for years to come.</p>
							<a href="index.php" class="site-btn sb-line" style="color: #000000;">DISCOVER</a>
						</div>
					</div>
					<div class="offer-card text-white">
						<span>only</span>
						<h4>$20.99</h4>
						<p>Buy Now</p>
					</div>
				</div>
			</div>
			<div class="hs-item set-bg" data-setbg="./assets/img/slider2.jpg">
				<div class="container">
					<div class="row">
						<div class="col-xl-6 col-lg-7"  style="color: #ffffff;">
						<h1 style="color: #0077b6;">JayStore</h1>
							<p  style="color: #fff; font-weight: bold; ">At JayStore, we are committed to delivering products that meet the highest standards of quality, ensuring our customers receive durable and well-crafted apparel that they can enjoy for years to come.</p>
							<a href="index.php" class="site-btn sb-line" style="color: #000000;">DISCOVER</a>
						</div>
					</div>
					<div class="offer-card text-white">
						<span>only</span>
						<h4>$10.99</h4>
						<p>Buy Now</p>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="slide-num-holder" id="snh-1"></div>
		</div>
	</section>
	<!-- Hero section end -->


	<!-- latest product section -->
	<section class="top-letest-product-section">
		<div class="container">
			<div class="section-title">
				<h2>LATEST PRODUCTS</h2>
				<?php
					if(isset($display_message))
					{
						foreach($display_message as $display_message){
							echo "<span>$display_message</span>";
						}
					}
				?>
			</div>
			<div class="product-slider owl-carousel">
			
				<?php
				
					while($row = mysqli_fetch_assoc($products))
					{

						?>
						<form method="POST" action="">
							<div class="product-item">
								<div class="pi-pic">
									<a href="product.php?product_id=<?php echo $row['product_id']?>"><img src="admin/img/<?php echo $row['image'] ?>"></a>
								</div>
								<div class="pi-text">
									<a href="product.php?product_id=<?php $row['product_id']?>"><h6>$<?php echo $row['price'] ?></h6></a>
									<a href="product.php?product_id=<?php $row['product_id']?>"><p><?php echo $row['product_name'] ?></p></a>
								</div>
								<input type="hidden" name="product_id" value="<?php echo $row['product_id']?>">
								<input type="hidden" name="product_name" value="<?php echo $row['product_name']?>">
								<input type="hidden" name="unit_price" value="<?php echo $row['price'] ?>">
								<input type="hidden" name="product_image" value="<?php echo $row['image'] ?>">
								<button type="submit" value="Add to Cart" class="site-btn" name="add_to_cart">Add to Cart</button>
							</div>
						</form>
					<?php
					}

					?>
				
			</div>
		</div>
	</section>
	<!-- latest product section end -->


<?php
    require_once 'inc/footer.php'
?>



	