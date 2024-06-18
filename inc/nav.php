<?php
	require_once 'functions/functions.php';
	$cat = display_cat();
	
?>

	<!-- Header section -->
	<header class="header-section">
		<div class="header-top"> 
			<div class="container">
				<div class="row">
					<div class="col-lg-2 text-center text-lg-left">
						<!-- logo -->
						<a href="./index.php" class="site-logo">
							<h1 style="font-family: cursive; font-size: 30px; color: #0077b6; text-align: center;">JayStore</h1>
						</a>
					</div>
					<div class="col-xl-6 col-lg-5">
						<form class="header-search-form" action="search_product.php" method="GET">
							<input type="text" placeholder="Search on Store ...." name="search">
							<button type="submit" name="search_data_product"><i class="flaticon-search"></i></button>
						</form>
					</div>
					<div class="col-xl-4 col-lg-5">
						<div class="user-panel">
							<div class="up-item">

								<?php
									if(isset($_SESSION['EMAIL_USER_LOGIN']))
									{
										// Get user_id from session
										$user_id = $_SESSION['user_id'];		
										$count_cart_items=mysqli_query($con,"select * from cart WHERE user_id = $user_id") or die('query failed');
										$row_count=mysqli_num_rows($count_cart_items);
								?>
									<i class="flaticon-profile"></i>
									<a href="logout.php">Logout</a>&nbsp;|&nbsp;<a href="order_history.php">Order History</a>&nbsp;
									<div class="up-item">
										<div class="shopping-card">
											<i class="flaticon-bag"></i>
											<span id="cart_counter"><?php echo $row_count ?></span>
										</div>
										<a href="cart.php">Shopping Cart</a>
									</div>
								<?php
									}
									else
									{
								?>
									<i class="flaticon-profile"></i>
									<a href="login.php">Sign</a> In or <a href="register.php">Create Account</a>
									<div class="up-item">
										<div class="shopping-card">
											<i class="flaticon-bag"></i>
											<span id="cart_counter">0</span>
										</div>
										<a href="login.php">Shopping Cart</a>
									</div>
								<?php
									}
								
								?>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<nav class="main-navbar">
			<div class="container">
				<!-- menu -->
				<ul class="main-menu">

					<li><a href="index.php">Home</a></li>

						<?php
							while($row = mysqli_fetch_assoc($cat))
							{
								?>

					<li><a href="category.php?category_id=<?php echo $row['category_id']?>"><?php echo $row['name']?></a></li>
						<?php
								}
							?>
					<li><a href="contact.php">Contact Us</a></li>
				</ul>
			</div>
		</nav>
	</header>
	<!-- Header section end -->


