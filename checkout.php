<!-- Group Members:
Krunal Chhabhaya – 8890229
Priyanshu Kumar Bhardwaj – 8828610
Faizansayeed Mohammed – 8878625
Sahil Sharma – 8903063 -->

<?php
session_start();

include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION["user_id"]; 
    $product_id = $_POST['product_id'];
    $quantity = $_POST['modal_quantity'];  
    $user_address = $_POST['address']; 
    $user_email = $_POST['email']; 
    $user_mobile = $_POST['mobile']; 
    $ord_size = $_POST['modal_size'];

    $product_query = "SELECT price FROM product WHERE product_id = '$product_id'";
    $product_result = mysqli_query($conn, $product_query);

    if ($product_result && mysqli_num_rows($product_result) > 0) {
        $product_data = mysqli_fetch_assoc($product_result);
        $price = $product_data['price'];
        
        $total_price = $quantity * $price;

        $order_insert_query = "INSERT INTO `order` (ord_quantity, ord_size, user_address, user_email, user_mobile, user_user_id, total_price)
                               VALUES ('$quantity', '$ord_size', '$user_address', '$user_email', '$user_mobile', '$user_id', '$total_price')";

        if (mysqli_query($conn, $order_insert_query)) {
            $order_id = mysqli_insert_id($conn);

            $link_order_product_query = "INSERT INTO `order_has_product` (order_order_id, product_product_id)
                                         VALUES ('$order_id', '$product_id')";
            
            if (mysqli_query($conn, $link_order_product_query)) {
                $update_product_query = "UPDATE `product` SET quantity = quantity - '$quantity' WHERE product_id = '$product_id'";
                mysqli_query($conn, $update_product_query);

                header("Location: order.php");
                exit();
            } else {
                echo "Error linking order with product: " . mysqli_error($conn);
            }
        } else {
            echo "Error creating order: " . mysqli_error($conn);
        }
    } else {
        echo "Product details not found!";
    }
}
?>