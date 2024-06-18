<?php 
    require_once 'inc/header.php'; 

    active_status();
    //get data
    $value = view_cat();


?>



<?php require_once 'inc/nav.php'; ?>


<div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Manage Category</h1>
            </div>
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Category</div>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Category ID</th>
                                    <th>Category Name</th>
                                    <th>Status</th>
                                    <th colspan="3" class="text-center">Operations</th>
                                </tr>
                                <tr>
                                    <?php
                                    
                                        while($row=mysqli_fetch_assoc($value))
                                        {


                                            ?>
                                            <td><?php echo $row['category_id']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
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
                                                        echo "<a href='manage_category.php?opr=deactivate&category_id=".$row['category_id']."' class='btn btn-danger'>Deactivate</a>"; 
                                                    }
                                                    else
                                                    {
                                                        echo "<a href='manage_category.php?opr=activate&category_id=".$row['category_id']."' class='btn btn-success'>Activate</a>";
                                                    }

                                                ?>
                                                <a href="edit_cat.php?category_id=<?php echo $row['category_id'] ?>" class="btn btn-primary">Edit</a>
                                                <a href="del_cat.php?category_id=<?php echo $row['category_id'] ?>" class="btn btn-danger">Delete</a>
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