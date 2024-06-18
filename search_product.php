<?php require_once 'inc/header.php'; ?>

<?php require_once 'inc/nav.php'; ?>


<?php 

// Get the search query from the URL
$search = $_GET['search'];

$products = search_product($search);

	if(isset($_POST['add_to_cart']))
	{
		$product_id = $_POST['product_id'];
		$product_name = $_POST['product_name'];
		$unit_price = $_POST['unit_price'];
		$product_image = $_POST['product_image'];

		//select cart data based on condition
		$sql = "select * from cart where product_id='$product_id'";
		$statement = mysqli_query($con,$sql);
		if(mysqli_num_rows($statement) > 0)
		{
			$display_message[] = "product already added to cart";
		}
		else{
			//insert into cart table
			$query = "INSERT INTO cart(product_id,product_name,unit_price,quantity,image) VALUES ('$product_id','$product_name','$unit_price', '1', '$product_image')";
			$result = mysqli_query($con,$query);
			$display_message[] = "product added to cart";
			header('location:index.php');
		}

	}

?>


<body>


	<!-- search result section -->
	<section class="top-letest-product-section">
		<div class="container">
			<div class="section-title">
				<h2>Search Results</h2>
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
	<!-- search result section end -->


	


<?php
    require_once 'inc/footer.php'
?>



	