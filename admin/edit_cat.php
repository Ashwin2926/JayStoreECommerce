<?php require_once 

    'inc/header.php'; 
    if(isset($_GET['category_id']) && $_GET['category_id'] != "")
    {
        $category_id = safe_value($con,$_GET['category_id']);
        $sql = "select * FROM categories where category_id='$category_id'";
        $result = mysqli_query($con,$sql);

        while($row=mysqli_fetch_assoc($result))
        {
            $category_id = $row['category_id'];
            $name = $row['name'];
            $status = $row['status'];
        }
    }
    update_category();
                            

?>



<?php require_once 'inc/nav.php'; ?>


<div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            
            <div class="page-content fade-in-up">
                
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Edit Category</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form class="form-horizontal" id="form-sample-1" method="post" novalidate="novalidate">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Category Name</label>

                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="category_up" value="<?php echo $name; ?>">
                                    <input type="hidden" name="cat_id" value="<?php echo $category_id; ?>">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-sm-10 ml-sm-auto">
                                    <button class="btn btn-info" type="submit" name="cat_btn_up">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                  
            <!-- END PAGE CONTENT-->




<?php require_once 'inc/footer.php'; ?>