<?php
    $id = $_POST['id'];
    $outp = '';
    require_once('../config/db_config.php');

    $query = "SELECT nameplant FROM plant WHERE plantid = '$id'";
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));;

    while($row = mysqli_fetch_array($result)) {
        $outp .= $row['nameplant'];
    }

    echo $outp;
?>