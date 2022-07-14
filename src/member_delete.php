<?php
    session_start();
    require_once('../config/db_config.php');
    error_reporting(0);

    $id = $_GET['remove'];
    $sql = "DELETE FROM cart WHERE id ='$id'";

    $data = mysqli_query($conn, $sql);

    mysqli_close($conn);
    header("Location: ../shopping_cart.php?m=success"); 
?>