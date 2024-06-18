<?php 
   require_once('inc/header.php');
?>

<div class="row">
    <div class="col-lg-4 m-auto">

        <div class="card mt-5">
            <div class="card-header">
                <h3>Admin Login</h3>
            </div>
            <?php 
                login_system();
                display_message();
            ?>
            <div class="card-body">
                <form method="post">
                     <input class="form-control mb-2" type="text" placeholder="Username or Email" id="username" name="username">
                     <input class="form-control" type="password" id="password" name="password" placeholder="Password">
            </div>
            <div class="card-footer">
                        <div class="field">
                            <button type="submit" class="btn btn-success" name="btn_login">Login</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php 
   require_once('inc/footer.php');
?>