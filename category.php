<?php require_once 'inc/header.php'; ?>

<?php require_once 'inc/nav.php'; ?>

<?php

	$cat = display_cat();

	$category_id = "";

	if(isset($_GET['category_id']))
	{
		$category_id = mysqli_real_escape_string($con,$_GET['category_id']);
	}
	$particular_product =  get_products($category_id);
?>


	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>CAtegory PAge</h4>
			<div class="site-pagination">
				<a href="">Home</a> /
				<a href="">Shop</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->


	<!-- Category section -->
	<section class="category-section spad">
		<div class="container">
			<div class="row">

				<div class="col-lg-3 order-2 order-lg-1">
					<div class="filter-widget">
						<h2 class="fw-title">Categories</h2>
						<ul class="category-menu">
							<?php
								while($row = mysqli_fetch_assoc($cat))
								{
							?>
									<li><a href="category.php?category_id=<?php echo $row['category_id']?>"><?php echo $row['name']?></a></li>
							<?php
								}
							?>
						</ul>
					</div>
				</div>

					
				<div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
					<div class="row">
						<?php
							if(mysqli_num_rows($particular_product))
							{
								while($row = mysqli_fetch_assoc($particular_product))
								{
						?>
									<div class="col-lg-4 col-sm-6">
										<div class="product-item">
											<div class="pi-pic">
												<div class="tag-sale">ON SALE</div>
												<a href="product.php?product_id=<?php echo $row['product_id']?>"><img src="admin/img/<?php echo $row['image'] ?>" alt=""></a>
												<div class="pi-links">
													<a href="product.php?product_id=<?php echo $row['product_id']?>" class="add-card"><i class="flaticon-bag"></i><span>SEE PRODUCT</span></a>
													<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
												</div>
											</div>
											<div class="pi-text">
											<a href="product.php?product_id=<?php $row['product_id']?>"><h6>$<?php echo $row['price'] ?></h6></a>
											<a href="product.php?product_id=<?php $row['product_id']?>"><p><?php echo $row['product_name'] ?></p></a>
											</div>
										</div>
									</div>
						<?php
								}
							}
							else
							{
								echo "Products out of stock";
							}
						
						?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Category section end -->


<?php
    require_once 'inc/footer.php'
?>
