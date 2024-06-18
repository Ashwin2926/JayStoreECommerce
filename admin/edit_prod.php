<?php 

    require_once 'inc/header.php';
    
    $cat=view_cat();
    $edit_product = update_product();

    while($row=mysqli_fetch_assoc($edit_product))
    {
        $product_id = $row['product_id'];
        $category_id = $row['category_id'];
        $product_name = $row['product_name'];
        $description = $row['description'];
        $price = $row['price'];
        $stock_quantity = $row['stock_quantity'];
        $image = $row['image'];
        
    }

?>



<?php require_once 'inc/nav.php'; ?>


<div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            
            <div class="page-content fade-in-up">
                
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Edit Product</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form class="form-horizontal" id="form-sample-1" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <select name="category_id">
                                        <option value="">Select Category</option>
                                        <?php

                                            while($row = mysqli_fetch_assoc($cat))
                                            {
                                                if($category_id==$row['category_id'])
                                                {

                                                ?>
                                                <option value="<?php echo $row['category_id']?>"><?php echo $row['name'] ?></option>
                                                <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <option value="<?php echo $row['category_id']?>"><?php echo $row['name'] ?></option>
                                                    <?php
                                                }
                                            }

                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Product Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                    <input class="form-control" type="text" name="product_name" value="<?php echo $product_name; ?>" >
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Price</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="price" value="<?php echo $price; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Quantity</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="quantity" value="<?php echo $stock_quantity; ?>" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Product Image</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="image" value="<?php echo $image; ?>">
                                    <img src="img/<?php echo $image ?>" width="50px" height="50px" class="img-circle">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" cols="30" rows="10" type="text" name="description"><?php echo $description; ?></textarea>
                                </div>
                            </div>
                            <button class="btn btn-info my-4 mx-0" type="submit" name="pro_btn_up">Submit</button>
                           
                        </form>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <?php 
                            update_record();
                            display_message();
                        ?>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->


<?php require_once 'inc/footer.php'; ?>