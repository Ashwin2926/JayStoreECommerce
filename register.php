<?php
    require_once 'inc/header.php'
?>

<?php
    require_once 'inc/nav.php'
?>

<!-- Page info -->
<div class="page-top-info">
		<div class="container">
			<h4>Registration</h4>
			<div class="site-pagination">
				<a href="index.php">Home</a> /
				<a href="register.php">Register</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->

	<!-- Contact section -->
	<section class="contact-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 contact-info">
					<h2>Create Account</h2>
					<div id="error"></div>
                    <div id="success"></div>
					<form class="contact-form" method="POST">
						<input type="text" placeholder="First Name" id="first_name">
						<input type="text" placeholder="Last Name" id="last_name">
						<input type="text" placeholder="Address" id="address">
                        <input type="text" placeholder="City" id="city">
						<input type="text" placeholder="State" id="state">
						<input type="text" placeholder="Zipcode" id="zipcode">
                        <input type="text" placeholder="Phone Number" id="phone">
                        <input type="email" placeholder="Email" id="email">
                        <input type="password" placeholder="Password" id="password">
                        <input type="password" placeholder="Confirm Password" id="cpassword">
						<button type="button" id="btn_register" class="site-btn">Register</button>
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
