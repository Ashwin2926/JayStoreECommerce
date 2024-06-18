<?php 
    require_once 'inc/header.php'; 

    //get data
    $value = view_contact();

?>

<?php require_once 'inc/nav.php'; ?>

<div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Manage Contact</h1>
            </div>
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Contact</div>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Conatct ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Operation</th>
                                </tr>
                                <tr>
                                    <?php
                                    
                                        while($row=mysqli_fetch_assoc($value))
                                        {
                                            ?>
                                            <td><?php echo $row['contact_id']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['subject']; ?></td>
                                            <td><?php echo $row['message']; ?></td>
                                            <td><a href="del_contact.php?contact_id=<?php echo $row['contact_id'] ?>" class="btn btn-danger">Delete</a></td>
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