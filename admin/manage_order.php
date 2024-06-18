<?php 
    require_once 'inc/header.php'; 

    order_status();
    
    $sql = "SELECT o.order_id, o.name, o.total_price, o.created_at, o.status,
            GROUP_CONCAT(oi.product_id SEPARATOR ',') AS product_ids,
            GROUP_CONCAT(oi.product_name SEPARATOR ',') AS product_names,
            GROUP_CONCAT(oi.unit_price SEPARATOR ',') AS unit_prices,
            GROUP_CONCAT(oi.quantity SEPARATOR ',') AS quantities
        FROM
            orders o
        JOIN
            order_items oi ON o.order_id = oi.order_id
        GROUP BY
            o.order_id, o.user_id, o.total_price, o.created_at, o.status
        ORDER BY
            o.created_at DESC";
    $result = mysqli_query($con, $sql);    

?>

<?php require_once 'inc/nav.php'; ?>

<div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Manage Orders</h1>
            </div>
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">order</div>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer Name</th>
                                    <th>Total Amount</th>
                                    <th>Order Date</th>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Unit Price</th>
                                    <th>Quantities</th>
                                    <th>Status</th>
                                    <th colspan="3" class="text-center">Operations</th>
                                </tr>
                                <tr>
                                    <?php
                                    
                                        while($row=mysqli_fetch_assoc($result))
                                        {
                                            ?>
                                            <td><?php echo $row['order_id']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td>$<?php echo $row['total_price']; ?></td>
                                            <td><?php echo $row['created_at']; ?></td>
                                            <td><?php echo str_replace(',', '<br>', $row['product_ids']); ?></td>
                                            <td><?php echo str_replace(',', '<br>', $row['product_names']); ?></td>
                                            <td><?php echo str_replace(',', '<br>', $row['unit_prices']); ?></td>
                                            <td><?php echo str_replace(',', '<br>', $row['quantities']); ?></td>
                                            <td>
                                                <?php 

                                                    if($row['status']=='1')
                                                    {
                                                        echo "Processed"; 
                                                    }
                                                    else
                                                    {
                                                        echo "Pending"; 
                                                    }
                                                
                                                ?>
                                            </td>
                                            <td class="text-center">


                                                <?php 

                                                    if($row['status']=='1')
                                                    {
                                                        echo "<a href='manage_order.php?opr=deactivate&order_id=".$row['order_id']."' class='btn btn-blue'>Completed</a>"; 
                                                    }
                                                    else
                                                    {
                                                        echo "<a href='manage_order.php?opr=activate&order_id=".$row['order_id']."' class='btn btn-success'>Process</a>";
                                                    }

                                                ?>

                                                <a href="del_order.php?order_id=<?php echo $row['order_id'] ?>" class="btn btn-danger">Delete</a>
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