<?php
    require_once 'inc/header.php'
?>

<?php
    require_once 'inc/nav.php'
?>

<!-- Page info -->
<div class="page-top-info">
		<div class="container">
			<h4>Login</h4>
			<div class="site-pagination">
				<a href="index.php">Home</a> /
				<a href="login.php">Login</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->

	<!-- Contact section -->
	<section class="contact-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 contact-info">
					<h2>Login</h2>
					<div id="error"></div>
                    <div id="success"></div>
					<form class="contact-form" method="POST">
						<input type="email" placeholder="Email" id="email">
						<input type="password" placeholder="Password" id="password">
						<button type="button" id="btn_login" class="site-btn">Login</button>
					</form>
				</div>
			</div>
		</div>
	</section>
	<!-- Contact section end -->

	<!-- Related product section -->
	<section class="related-product-section spad">
		<div class="container">
			
			
		</div>
	</section>
	<!-- Related product section end -->

<?php
    require_once 'inc/footer.php'
?>
