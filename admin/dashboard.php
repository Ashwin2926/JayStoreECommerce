
<?php require_once 'inc/header.php'; ?>

<?php 

    if(!isset($_SESSION['ADMIN']))
    {
        header("location:index.php");
    }

?>

<?php require_once 'inc/nav.php'; ?>

<?php

$query = "SELECT COUNT(*) AS total_items FROM categories";
$result = mysqli_query($con,$query);
if ($result->num_rows > 0) {
    // Fetch total_items value
    $row = $result->fetch_assoc();
    $total_categories = $row["total_items"];
}else {
    $totalItems = 0;
}

$query = "SELECT COUNT(*) AS total_items FROM products";
$result = mysqli_query($con,$query);
if ($result->num_rows > 0) {
    // Fetch total_items value
    $row = $result->fetch_assoc();
    $total_products = $row["total_items"];
}else {
    $totalItems = 0;
}

$query = "SELECT COUNT(*) AS total_items FROM customers";
$result = mysqli_query($con,$query);
if ($result->num_rows > 0) {
    // Fetch total_items value
    $row = $result->fetch_assoc();
    $total_customers = $row["total_items"];
}else {
    $totalItems = 0;
}

$query = "SELECT COUNT(*) AS total_items FROM contacts";
$result = mysqli_query($con,$query);
if ($result->num_rows > 0) {
    // Fetch total_items value
    $row = $result->fetch_assoc();
    $total_contacts = $row["total_items"];
}else {
    $totalItems = 0;
}

$query = "SELECT COUNT(*) AS total_orders FROM orders";
$result = mysqli_query($con,$query);
if ($result->num_rows > 0) {
    // Fetch total_items value
    $row = $result->fetch_assoc();
    $total_orders = $row["total_orders"];
}else {
    $totalorders = 0;
}

$query = "SELECT COUNT(*) AS total_orders FROM orders where status = '1'";
$result = mysqli_query($con,$query);
if ($result->num_rows > 0) {
    // Fetch total_items value
    $row = $result->fetch_assoc();
    $total_processed_orders = $row["total_orders"];
}else {
    $total_processed_orders = 0;
}

$query = "SELECT COUNT(*) AS total_orders FROM orders where status = '0'";
$result = mysqli_query($con,$query);
if ($result->num_rows > 0) {
    // Fetch total_items value
    $row = $result->fetch_assoc();
    $total_pending_orders = $row["total_orders"];
}else {
    $total_pending_orders = 0;
}



?>



<div class="page-wrapper">
      
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-success color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong"><?php echo $total_orders; ?></h2>
                                <div class="m-b-5">Orders</div><i class="ti-shopping-cart widget-stat-icon"></i>
                                <div><i class="fa fa-level-up m-r-5"></i><small>Total Orders</small></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-success color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong"><?php echo $total_processed_orders; ?></h2>
                                <div class="m-b-5">Processed Orders</div><i class="ti-shopping-cart widget-stat-icon"></i>
                                <div><i class="fa fa-level-up m-r-5"></i><small>Processed Orders</small></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-info color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong"><?php echo $total_pending_orders; ?></h2>
                                <div class="m-b-5">Pending Orders</div><i class="ti-bar-chart widget-stat-icon"></i>
                                <div><i class="fa fa-level-up m-r-5"></i><small>Total Pending Orders</small></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-warning color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong"><?php echo $total_customers; ?></h2>
                                <div class="m-b-5">CUSTOMERS</div><i class="fa fa-money widget-stat-icon"></i>
                                <div><i class="fa fa-level-up m-r-5"></i><small>Total Registered</small></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-success color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong"><?php echo $total_categories; ?></h2>
                                <div class="m-b-5">CATEGORIES</div><i class="ti-shopping-cart widget-stat-icon"></i>
                                <div><i class="fa fa-level-up m-r-5"></i><small>Total ACTIVE</small></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-info color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong"><?php echo $total_products; ?></h2>
                                <div class="m-b-5">PRODUCTS</div><i class="ti-bar-chart widget-stat-icon"></i>
                                <div><i class="fa fa-level-up m-r-5"></i><small>Total In Stock</small></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-warning color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong"><?php echo $total_customers; ?></h2>
                                <div class="m-b-5">CUSTOMERS</div><i class="fa fa-money widget-stat-icon"></i>
                                <div><i class="fa fa-level-up m-r-5"></i><small>Total Registered</small></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-danger color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong"><?php echo $total_contacts; ?></h2>
                                <div class="m-b-5">CONTACTS</div><i class="ti-user widget-stat-icon"></i>
                                <div><i class="fa fa-level-down m-r-5"></i><small>Total Subscribers</small></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
            <footer class="page-footer">
                <div class="font-13">2018 © <b>AdminCAST</b> - All rights reserved.</div>
                <a class="px-4" href="http://themeforest.net/item/adminca-responsive-bootstrap-4-3-angular-4-admin-dashboard-template/20912589" target="_blank">BUY PREMIUM</a>
                <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
            </footer>
        </div>
    </div>
    

<?php require_once 'inc/footer.php'; ?>

