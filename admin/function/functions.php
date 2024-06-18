<?php

    //Set Session Message
    function set_message($msg)
    {
        if(!empty($msg)){
            $_SESSION['MESSAGE']=$msg;
        }
        else{
            $msg = "";
        }
    }

    
    //Display Message
    function display_message()
    {
        if(isset($_SESSION['MESSAGE']))
        {
            echo $_SESSION['MESSAGE'];
            unset ($_SESSION['MESSAGE']);
        }
    }

    //Error Message
    function display_error($error)
    {
        return "<span class='alert alert-danger text-center'>$error</span>";
    }

    //Success Message
    function display_success($success)
    {
        return "<span class='alert alert-success text-center'>$success</span>";
    }

    //Get safe value
    function safe_value($con, $value)
    {
        return mysqli_real_escape_string($con, $value);
    }
    

    //Login Checking
    function login_system()
    {

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn_login']))
        {
            global $con;
            $username = safe_value($con, $_POST['username']);
            $password = safe_value($con, $_POST['password']);

            if(empty($username) || empty($password))
            {
                set_message(display_error("Please Fill In The Blanks"));
            }
            else{

                //query
                $query = "select * from admins where username='$username' AND password='$password' ";
                $result = mysqli_query($con, $query);

                if(mysqli_fetch_assoc($result))
                {
                    $_SESSION['ADMIN']=$username;
                    header("location: ./dashboard.php");
                }
                else{
                    set_message(display_error("You Have Entered Wrong Password or Username"));
                }
            }
            
        }

    }


//----------------CATEGORY PAGE--------------------------------------------------------------//

    //Add Category
    function add_category()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cat_btn']))
        {
            global $con;
            $category = safe_value($con, $_POST['category']);

            if(empty($category))
            {
                set_message(display_error("Please Enter Category Name"));
            }
            else
            {

                $sql = "select * from categories where name = '$category'";
                $check = mysqli_query($con,$sql);

                //check if record already exists
                if(mysqli_fetch_assoc($check)){

                    set_message(display_error("Category Already Exists"));

                }
                else{

                    //query
                    $query = "insert into categories (name, status) values ('$category','1')";
                    $result = mysqli_query($con, $query);

                    if($result)
                    {
                        set_message(display_success("Category Saved!!"));
                        echo "<a href='manage_category.php'>View Category</a>";
                    }

                }

                
            }
            
        }
    }

    //view category
    function view_cat(){
        global $con;
        $sql = "select * from categories";
        return mysqli_query($con,$sql);
    }

    //activate and deactivate category status
    function active_status()
    {
        global $con;

        if(isset($_GET['opr']) && $_GET['opr'] != "")
        {
            $operation = safe_value($con,$_GET['opr']);
            $category_id = safe_value($con,$_GET['category_id']);

            if($operation == 'activate')
            {
                $status = 1;
            }
            else{
                $status = 0;
            }

            $query =  "update categories set status='$status' where category_id='$category_id'";
            $result = mysqli_query($con,$query);

            if($result){
                header("location:manage_category.php");
            }

        }

    }


    //update Category
    function update_category()
    {
        global $con;
        if(isset($_POST['cat_btn_up']))
        {
            $category_name = safe_value($con, $_POST['category_up']);
            $category_id = safe_value($con,$_POST['cat_id']);

            if(!empty($category_name))
            {
                
                $sql = "update categories set name = '$category_name' where category_id='$category_id'";
                $result = mysqli_query($con,$sql);
                if($result)
                {
                    header("location: manage_category.php");
                }
            }

        }
    }


//---------------------------PRODUCT PAGE--------------------------------------------------------------//

// Save product
function save_product()
{
    global $con;
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pro_btn']))
    {
        $category_id = safe_value($con, $_POST['cat_id']);
        $product_name = safe_value($con, $_POST['product_name']);
        $description = safe_value($con, $_POST['description']);
        $price = safe_value($con, $_POST['price']);
        $stock_quantity = safe_value($con, $_POST['quantity']);

        $image = $_FILES['product_image']['name'];
        $type = $_FILES['product_image']['type'];
        $tmp_name = $_FILES['product_image']['tmp_name'];
        $size = $_FILES['product_image']['size'];

        $img_ext = explode('.',$image);
        $img_correct_ext = strtolower(end($img_ext));
        $allow = array('jpg', 'png', 'jpeg');
        $path = "img/".$image;

        if(in_array($img_correct_ext,$allow))
        {
            if($size<500000)
            {
                if($category_id == 0)
                {
                    set_message(display_error("Please select category"));
                }
                else
                {
                    $query = "insert into products(category_id,product_name,description,price,stock_quantity,image,status) values ('$category_id','$product_name','$description','$price','$stock_quantity','$image','1')";
                    $result = mysqli_query($con,$query);

                    if($result){
                        set_message(display_success("Product Saved Successfully!!"));
                        move_uploaded_file($tmp_name,$path);
                    }
                }
            }
        }
        else
        {
            set_message(display_error("You can't store this file :("));
            
        }

    }
}


//View Products
function view_product()
{
    global $con;
    $query = "select products.product_id, categories.name, products.product_name, products.description, products.price, products.stock_quantity, products.image, products.status from products INNER JOIN categories on products.category_id = categories.category_id";
    return $result = mysqli_query($con,$query);
    
}

//activate and deactivate product status
function active_status_product()
{
    global $con;

    if(isset($_GET['opr']) && $_GET['opr'] != "")
    {
        $operation = safe_value($con,$_GET['opr']);
        $product_id = safe_value($con,$_GET['product_id']);

        if($operation == 'activate')
        {
            $status = 1;
        }
        else{
            $status = 0;
        }

        $query =  "update products set status='$status' where product_id='$product_id'";
        $result = mysqli_query($con,$query);

        if($result){
            header("location:manage_product.php");
        }

    }

}

//get update product
function update_product()
{
    global $con;

    if(isset($_GET['product_id']))
    {
        $edit_id = safe_value($con, $_GET['product_id']);
        $sql = "select * from products where product_id='$edit_id'";
        $result = mysqli_query($con,$sql);
        return $result;

    }
}

//update actual record now
function update_record(){
    
    global $con;

    if(isset($_POST['pro_btn_up']))
    {
        $category_id = safe_value($con, $_POST['category_id']);
        $product_id = safe_value($con, $_POST['product_id']);
        $product_name = safe_value($con, $_POST['product_name']);
        $description = safe_value($con, $_POST['description']);
        $price = safe_value($con, $_POST['price']);
        $stock_quantity = safe_value($con, $_POST['quantity']);

        $image = $_FILES['image']['name'];
        $type = $_FILES['image']['type'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $size = $_FILES['image']['size'];

        $img_ext = explode('.',$image);
        $img_correct_ext = strtolower(end($img_ext));
        $allow = array('jpg', 'png', 'jpeg');
        $path = "img/".$image;

        if(in_array($img_correct_ext,$allow))
        {
            if($size<500000)
            {
                if($category_id == 0)
                {
                    set_message(display_error("Please select category"));
                }
                else
                {
                    $query = "update products set category_id='$category_id',product_name='$product_name',description='$description',price='$price',stock_quantity='$stock_quantity',image='$image' where product_id='$product_id'";
                    $result = mysqli_query($con,$query);

                    if($result){
                        set_message(display_success("Product Updated Successfully!!"));
                        move_uploaded_file($tmp_name,$path);
                        //header("location:manage_product.php");
                    }
                }
            }
        }
        else
        {
            set_message(display_error("You can't store this file :("));
            
        }
    }

}



////////////////Contacts List
function view_contact()
{
    global $con;
    $query = "select * from contacts";
    return $result = mysqli_query($con,$query);
    
}



////////////////Customer List Management

//view category
function view_customer(){
    global $con;
    $sql = "select * from customers";
    return mysqli_query($con,$sql);
}

//activate and deactivate customer status
function active_status_customer()
{
    global $con;

    if(isset($_GET['opr']) && $_GET['opr'] != "")
    {
        $operation = safe_value($con,$_GET['opr']);
        $customer_id = safe_value($con,$_GET['customer_id']);

        if($operation == 'activate')
        {
            $status = 1;
        }
        else{
            $status = 0;
        }

        $query =  "update customers set status='$status' where customer_id='$customer_id'";
        $result = mysqli_query($con,$query);

        if($result){
            header("location:manage_customer.php");
        }

    }

}




////////////////Order List Management

//view orders
function view_order(){
    global $con;
    //$sql = "select * from orders";
    $sql = "SELECT o.order_id, o.user_id, o.total_price, o.created_at, o.status,
    GROUP_CONCAT(oi.product_id SEPARATOR ';') AS product_ids,
    GROUP_CONCAT(oi.product_name SEPARATOR ';') AS product_names,
    GROUP_CONCAT(oi.unit_price SEPARATOR ';') AS unit_prices,
    GROUP_CONCAT(oi.quantity SEPARATOR ';') AS quantities
    FROM
        orders o
    JOIN
        order_items oi ON o.order_id = oi.order_id
    GROUP BY
        o.order_id, o.user_id, o.total_price, o.created_at, o.status
    ORDER BY
        o.created_at DESC";
    return mysqli_query($con,$sql);
}

//processing and shipping order status
function order_status()
{
    global $con;

    if(isset($_GET['opr']) && $_GET['opr'] != "")
    {
        $operation = safe_value($con,$_GET['opr']);
        $order_id = safe_value($con,$_GET['order_id']);

        if($operation == 'activate')
        {
            $status = 1;
        }
        else{
            $status = 0;
        }

        $query =  "update orders set status='$status' where order_id='$order_id'";
        $result = mysqli_query($con,$query);

        if($result){
            header("location:manage_order.php");
        }

    }

}