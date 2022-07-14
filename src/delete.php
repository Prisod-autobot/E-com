<?php
        require_once('../config/db_config.php');

        error_reporting(0);

        $plant_id = $_GET['id'];
        $img1 = $_GET['img1'];
        $img2 = $_GET['img2'];
        $img3 = $_GET['img3'];

        $local = "upload/";
        
        $fileImg = array($img1, $img2, $img3);
        $sql = "DELETE FROM plant WHERE plantid ='$plant_id'";

        $data = mysqli_query($conn, $sql);

        mysqli_close($conn);
        header("Location: ../admin.php?m=success"); 
?>