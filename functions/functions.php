<?php

    require_once 'db.php';

//Display categories
function display_cat(){

    global $con;
    $query = "select * from categories where status = 1";
    return mysqli_query($con,$query);

}

//Display the latest products on index page and category page
/*function get_products($category_id="", $product_id="")
{
    global $con;
    $query = "select * from products where status = 1 order by product_id desc";
    
    if($category_id!='')
    {
        $query = "select * from products where category_id = $category_id";
    }
    if($product_id!='')
    {
        $query = "select * from products where product_id = $product_id";
    }
    return mysqli_query($con,$query);
}*/

function get_products($category_id = "", $product_id = "")
{
    global $con;

    // Start a transaction
    $con->begin_transaction();

    // Update the status of products with a stock quantity of 0 to 0
    $query = "UPDATE products SET status = 0 WHERE stock_quantity = 0";
    $result = mysqli_query($con, $query);

    // Select active products with a stock quantity greater than 0
    $query = "SELECT * FROM products WHERE status = '1' ORDER BY product_id DESC";

    if ($category_id != '') {
        $query = "SELECT * FROM products WHERE category_id = '$category_id' AND status = '1'";
    }
    if ($product_id != '') {
        $query = "SELECT * FROM products WHERE product_id = $product_id AND status = '1'";
    }

    $result = mysqli_query($con, $query);

    // Commit the transaction if there were no errors
    $con->commit();

    // Return the result set
    return $result;
}


 //Get safe value
 function safe_value($con, $value)
 {
     return mysqli_real_escape_string($con, $value);
 }


 /////////////CART//////////////////
 //view cart list
function view_cart($user_id){
    global $con;
    $sql = "select * from cart WHERE user_id = $user_id";
    return mysqli_query($con,$sql);
}


/////Search for products
function search_product($search)
{
    global $con;
    $search = mysqli_real_escape_string($con, $search);

    $query = "SELECT * FROM products WHERE product_name LIKE '%$search%'";
    return mysqli_query($con,$query);
   
}

  //Delete cart items after order processing
function delete_cart_items($user_id){
    
    global $con;
    $query = "DELETE FROM cart WHERE user_id = $user_id";
    mysqli_query($con, $query);
    return mysqli_query($con,$query);
  }

