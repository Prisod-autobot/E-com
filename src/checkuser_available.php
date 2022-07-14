<?php
    include_once('./register_db_config.php');

    $usernamecheck = new DB_con();

    //get post values from
    $uname = $_POST['username'];

    $sql = $usernamecheck->usernameavailable($uname);
    $num = mysqli_num_rows($sql);

    
    if($num>0){
        echo "<span style='color:red;'>ชื่อบัญชีถูกใช้ไปแล้ว</span>";
        echo "<script>$('#submit').prop('disabled', true);</script>";
    }else if(strlen($uname)<=5){
        echo "<span style='color:red;'>ชื่อตัวอักษรอย่างน้อย 5 ตัว</span>";
        echo "<script>$('#submit').prop('disabled', true);</script>";
    }
    else{
        echo "<span style='color:green;'>สามารถใช้ชื่อบัญชีนี้ได้</span>";
        echo "<script>$('#submit').prop('disabled', false);</script>";        
    }

?>