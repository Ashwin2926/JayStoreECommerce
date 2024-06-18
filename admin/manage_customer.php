<?php 
    require_once 'inc/header.php'; 

    active_status_customer();
    //get data
    $value = view_customer();

?>

<?php require_once 'inc/nav.php'; ?>

<div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Manage Customer</h1>
            </div>
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Customer</div>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Customer ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Zipcode</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th colspan="3" class="text-center">Operations</th>
                                </tr>
                                <tr>
                                    <?php
                                    
                                        while($row=mysqli_fetch_assoc($value))
                                        {
                                            ?>
                                            <td><?php echo $row['customer_id']; ?></td>
                                            <td><?php echo $row['first_name']; ?></td>
                                            <td><?php echo $row['last_name']; ?></td>
                                            <td><?php echo $row['address']; ?></td>
                                            <td><?php echo $row['city']; ?></td>
                                            <td><?php echo $row['state']; ?></td>
                                            <td><?php echo $row['zipcode']; ?></td>
                                            <td><?php echo $row['phone']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
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
                                                        echo "<a href='manage_customer.php?opr=deactivate&customer_id=".$row['customer_id']."' class='btn btn-danger'>Deactivate</a>"; 
                                                    }
                                                    else
                                                    {
                                                        echo "<a href='manage_customer.php?opr=activate&customer_id=".$row['customer_id']."' class='btn btn-success'>Activate</a>";
                                                    }

                                                ?>

                                                <a href="del_cust.php?customer_id=<?php echo $row['customer_id'] ?>" class="btn btn-danger">Delete</a>
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