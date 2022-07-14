<?php
    session_start();
    require_once('../config/db_config.php');
    $id_user = $_SESSION['id'];

    if(isset($_GET['cart_item']) && isset($_GET['cart_item']) == 'cart_item'){
            $sql = "SELECT qty FROM cart WHERE qty = '$id_user'";
            $num_row = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $num_result = mysqli_num_rows($num_row);

            echo $num_result;
    }
    if(isset($_POST['qty'])){

        $qty = $_POST['qty'];
        $price = $_POST['price'];
        $id_cart = $_POST['pid'];

        $total_price = $price * $qty;
        $sql = "UPDATE cart SET total_product ='$qty', total_price = '$total_price' WHERE id = '$id_cart'";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
    mysqli_close($conn);
?>