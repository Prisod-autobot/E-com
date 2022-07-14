<?php
    session_start();
    include_once('register_db_config.php');
    $numberUser = $_SESSION['id'];
    $userdata = new DB_con();
    $notActiveStatus = 0;

    if($notActiveStatus == 0){
        setcookie('nom','0',time() + 86400,'/');
        $status = $userdata->notActive($numberUser,$notActiveStatus);
        session_destroy();
        header("location: ../login");
    }else{
        echo ("<script> alert('wrong'); </script>");
        header("location: google.com");
    }
?>