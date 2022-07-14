<?php
    require_once('../config/db_config.php');

        $nameComment = $_POST['nameComment'];
        $comment = $_POST['comment'];

        $sql = "INSERT INTO comment_users (nameComment, comment_ip) VALUES ('$nameComment', '$comment');";

        $result = mysqli_query($conn, $sql);
        if($result){
            echo "<script>
            alert('ส่งข้อมูลแล้ว');
        </script>";
            mysqli_close($conn);
            header("Location: ../index");
        }else{
            echo "<script>
                alert('error');
            </script>";
            mysqli_close($conn);
        }
?>