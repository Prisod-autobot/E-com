<?php
require_once('../config/db_config.php');

if(isset($_POST) && !empty($_POST) && $_POST['function'] == "provinces"){

    $name_th = $_POST['name_th'];
    $sql_provinces = "SELECT * FROM provinces WHERE name_th = '$name_th'";
    $query_provinces = mysqli_query($conn,$sql_provinces);
    $row_provinces = mysqli_num_rows($query_provinces);
    if($row_provinces > 0){
        $result_provinces = mysqli_fetch_assoc($query_provinces);
        $province_id = $result_provinces['id'];
        $sql_amphures = "SELECT * FROM amphures WHERE province_id ='$province_id'";
        $query_amphures = mysqli_query($conn,$sql_amphures);
        echo '<option selected disabled>กรุณาเลือกอำเภอ</option>';
        foreach($query_amphures as $value){
            echo '<option value="'.$value['name_th'].'">'.$value['name_th'].'</option>';
        }
    }
}

if(isset($_POST) && !empty($_POST) && $_POST['function'] == "amphures"){
    $name_th = $_POST['name_th'];
    $sql_amphures = "SELECT * FROM amphures WHERE name_th = '$name_th'";
    $query_amphures = mysqli_query($conn,$sql_amphures);
    $row_amphures = mysqli_num_rows($query_amphures);
    if($row_amphures > 0){
        $result_amphures = mysqli_fetch_assoc($query_amphures);
        $amphure_id = $result_amphures['id'];
        $sql_districts = "SELECT * FROM districts WHERE amphure_id ='$amphure_id'";
        $query_districts = mysqli_query($conn,$sql_districts);
        echo '<option selected disabled>กรุณาเลือกตำบล</option>';
        foreach($query_districts as $value){
            echo '<option value="'.$value['name_th'].'">'.$value['name_th'].'</option>';
        }
    }
}

if(isset($_POST) && !empty($_POST) && $_POST['function'] == "districts"){
    $name_th = $_POST['name_th'];
    $sql_districts = "SELECT * FROM districts WHERE name_th = '$name_th'";
    $query_districts = mysqli_query($conn,$sql_districts);
    $row_districts = mysqli_num_rows($query_districts);
    if($row_districts > 0){
        $result_districts = mysqli_fetch_assoc($query_districts);
        $id = $result_districts['id'];
        $sql_zipcode = "SELECT * FROM districts WHERE id ='$id'";
        $query_zipcode = mysqli_query($conn,$sql_zipcode);
        $row_zipcode = mysqli_num_rows($query_zipcode);
        if($row_zipcode > 0){
            $result_zipcode = mysqli_fetch_assoc($query_zipcode);
            echo $result_zipcode['zip_code'];
        }
    }
}
?>