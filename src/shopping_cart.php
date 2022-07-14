<?php
    session_start(); 
    $id_user = $_SESSION['id'];
    $cart_id = $_POST['id'];
    require_once('../config/db_config.php');

    $sql = "SELECT * FROM plant WHERE plantid = '$cart_id'";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $row = mysqli_fetch_assoc($result);

    $product_name = $row['nameplant'];
    $product_price = $row['price'];
    $product_img = $row['plantjpg2'];
    $total_product = 1;

    $sql = "SELECT product_id FROM cart WHERE product_id = '$cart_id' AND qty = '$id_user'";
    $result_product_code = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $code_id_product = mysqli_fetch_assoc($result_product_code);
    $id_product = $code_id_product['product_id'];

    if(!$id_product){
        $cart = "INSERT INTO cart (product_name, product_id, product_price, product_img, qty, total_product, total_price) VALUE ('$product_name','$cart_id', '$product_price', '$product_img', '$id_user', '$total_product', '$product_price')";
        $cart_result = mysqli_query($conn, $cart);
    }
    mysqli_close($conn);
?>