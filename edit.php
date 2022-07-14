<?php
    session_start();
    require_once './config/db_config.php';
    error_reporting(0);

    $id = $_SESSION['id'];
    $query = mysqli_query($conn, "SELECT * FROM users_oop WHERE id = '$id'");
    $resultad = mysqli_fetch_array($query);

    if($_SESSION['id'] == ""){
        header("location: login");
    }
    else if($resultad['ulevel'] != "a"){
        header("location: member");
    }
    else{

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="icon" type="image/svg+xml" href="assets/favicon.svg">

    <!-- all script -->
    <script src="./libs/jquery-3.6.0.min.js"></script>
    <script src="./libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="./libs/sweetalert2.all.min.js"></script>
    <script src="https://kit.fontawesome.com/ece49ec389.js" crossorigin="anonymous"></script>

    <!-- ส่วนเสริม -->
    <link rel="stylesheet" href="./libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./libs/sweetalert2.min.css">

    <link rel="stylesheet" href="./style/edit.css">


</head>

<body>

    <?php
        $plant_id = $_GET['id'];
        $sql = "SELECT * FROM plant WHERE plantid='$plant_id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
    ?>
    <div class="row">
        <h1 style="text-align:center">แก้ไขข้อมูล</h1>
    </div>

    <div class="container">
        <form action="" method="POST">
            <div class="row input-container">
                <div class="col-xs-12">
                    <div class="styled-input wide">
                        <input type="hidden" name="plantid" value="<?php echo $row['plantid'] ?>">
                        <input type="text" name="name" value="<?php echo $row['nameplant'] ?>" Required>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="styled-input">
                        <input type="number" name="number" value="<?php echo $row['numberplant'] ?>" Required>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="styled-input" style="float:right">
                        <input type="number" name="price" value="<?php echo $row['price'] ?>" Required>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="styled-input wide">
                        <textarea type="text" name="info" Required><?php echo $row['info'] ?></textarea>
                    </div>
                </div>
                <div class="col-xs-12">
                    <button class="btn-lrg cancel-btn" type="submit" name="go_home" value="Go_home">ยกเลิก</button>
                    <button class="btn-lrg submit-btn" type="submit" name="update" value="Update">แก้ไข</button>
                </div>
            </div>
        </form>
    </div>

    <?php
    if($_POST['go_home']){
        ?>
    <META HTTP-EQUIV="Refresh" CONTENT="0; URL=admin.php">
    <?php
    }
    if($_POST['update']){
        $plant_id = $_POST['plantid'];
        $name_plant = $_POST['name'];
        $number_plant = $_POST['number'];
        $price = $_POST['price'];
        $info = $_POST['info'];

        $sql = "UPDATE plant SET nameplant='$name_plant', info='$info', price='$price', numberplant='$number_plant' WHERE plantid='$plant_id'";
        $data = mysqli_query($conn, $sql);
        if($data){
            echo "<script>Swal.fire(
                'แก้ไขสำเร็จ',
                'กดปุ่มเพื่อกลับหน้าหลัก',
                'success'
            ).then(function(){
                window.location = './admin.php';
            });
            </script>";
        ?>
    <!-- <META HTTP-EQUIV="Refresh" CONTENT="0; URL=index.php"> -->
    <?php
        }else{
            echo "<script>Swal.fire('ข้อมูลผิดพลาด');</script>";
        }

        mysqli_close($conn);
    }
?>
</body>

</html>
<?php
    }
    ?>