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
    <link rel="icon" type="image/svg+xml" href="assets/favicon.svg">
    <title>Form</title>
    <link rel="icon" type="image/svg+xml" href="assets/favicon.svg">

    <!-- all script -->
    <script src="./libs/jquery-3.6.0.min.js"></script>
    <script src="./libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="./libs/sweetalert2.all.min.js"></script>
    <script src="https://kit.fontawesome.com/ece49ec389.js" crossorigin="anonymous"></script>

    <!-- ส่วนเสริม -->
    <link rel="stylesheet" href="./libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./libs/sweetalert2.min.css">

    <link rel="stylesheet" href="./style/form.css">

</head>

<body>
    <div class="bgForm">
        <div class="row">
            <h1 style="text-align:center">เพิ่มสินค้า</h1>
        </div>

        <div class="container">
            <form action="./src/insert.php" method="post" autocomplete="off" enctype="multipart/form-data">
                <div class="row input-container">
                    <div class="col-xs-12">
                        <div class="styled-input wide">
                            <input type="text" name="name" required placeholder="ชื่อ" />
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="styled-input">
                            <input type="number" name="number" required placeholder="จำนวน" />
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="styled-input" style="float:right">
                            <input type="number" name="price" required placeholder="ราคา" />
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="styled-input wide">
                            <textarea type="text" name="info" required placeholder="ข้อมูล"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="styled-input">
                            <input type="file" name="fileupload1" required id="fileupload1" />
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="styled-input">
                            <input type="file" name="fileupload2" required id="fileupload2" />
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="styled-input">
                            <input type="file" name="fileupload3" required id="fileupload3" />
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <button class="btn-lrg cancel-btn" onclick="window.location.href='admin';">ยกเลิก</button>
                        <button class="btn-lrg submit-btn" type="submit" name="submit" value="upload">เพิ่ม</button>
                    </div>

            </form>
        </div>
    </div>
</body>

</html>
<?php
    }
    ?>