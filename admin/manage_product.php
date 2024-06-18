<?php 
    require_once 'inc/header.php'; 

    active_status_product();
    //get data
    $value = view_product();

?>

<?php require_once 'inc/nav.php'; ?>

<div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Manage Product</h1>
            </div>
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Product</div>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Category Name</th>
                                    <th>Product Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Inventory</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th colspan="3" class="text-center">Operations</th>
                                </tr>
                                <tr>
                                    <?php
                                    
                                        while($row=mysqli_fetch_assoc($value))
                                        {
                                            ?>
                                            <td><?php echo $row['product_id']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['product_name']; ?></td>
                                            <td><?php echo $row['description']; ?></td>
                                            <td><?php echo $row['price']; ?></td>
                                            <td><?php echo $row['stock_quantity']; ?></td>
                                            <td><img src="img/<?php echo $row['image'] ?>" width="50px" height="50px" class="img-circle"></td>
                                            
                                            <td>
                                                <?php 

                                                    if($row['status']=='1')
                                                    {
                                                        echo "Active"; 
                                                    }
                                                    else
                                                    {
                                                        echo "In-Active"; 
                                                    }
                                                
                                                ?>
                                            </td>
                                            <td class="text-center">


                                                <?php 

                                                    if($row['status']=='1')
                                                    {
                                                        echo "<a href='manage_product.php?opr=deactivate&product_id=".$row['product_id']."' class='btn btn-danger'>Deactivate</a>"; 
                                                    }
                                                    else
                                                    {
                                                        echo "<a href='manage_product.php?opr=activate&product_id=".$row['product_id']."' class='btn btn-success'>Activate</a>";
                                                    }

                                                ?>
                                                <a href="edit_prod.php?product_id=<?php echo $row['product_id'] ?>" class="btn btn-primary">Edit</a>
                                                <a href="del_prod.php?product_id=<?php echo $row['product_id'] ?>" class="btn btn-danger">Delete</a>
                                            </td>
    

                                </tr>
                                    <?php


                                        }
                                    
                                    ?>
                               
                            </thead>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->

<?php require_once 'inc/footer.php'; ?>
