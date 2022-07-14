<?php
    include_once('./register_db_config.php');

    $usernamecheck = new DB_con();

    //get post values from
    $uemail = $_POST['email'];

    $sql = $usernamecheck->emailavailable($uemail);
    $num = mysqli_num_rows($sql);


        if($num>0){
            echo "<span style='color:red;'>อีเมลล์ถูกใช้ไปแล้ว</span>";
            echo "<script>$('#submit').prop('disabled', true);</script>";
        }else if($uemail == ""){
            echo "<span style='color:red;'>ไม่สามารถว่างช่องนี้ได้</span>";
            echo "<script>$('#submit').prop('disabled', true);</script>";
        }
        else{
            echo "<span style='color:green;'>สามารถใช้อีเมลล์นี้ได้</span>";
            echo "<script>$('#submit').prop('disabled', false);</script>";        
        }
?>