<?php
require_once './config/db_config.php';
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>comment</title>
    <link rel="icon" type="image/svg+xml" href="assets/favicon.svg">

    <script src="./libs/jquery-3.6.0.min.js"></script>
    <script src="./libs/anime.min.js"></script>
    <script src="./libs/aos.js"></script>
    <script src="./libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="./libs/sweetalert2.all.min.js"></script>
    <script src="https://kit.fontawesome.com/ece49ec389.js" crossorigin="anonymous"></script>

    <!-- ส่วนเสริม -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="./libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./libs/sweetalert2.min.css">
    <link rel="stylesheet" href="./style/home.css">
</head>

<body>
    <div class="d-grid col-6 mx-auto">
        <button onclick="window.location.href='index'" class="btn btn-danger">ย้อนกลับ</button>
    </div>
    <div class="card g-5 p-5">
        <form method="POST" action="./src/sentComment">
            <div class="form-control">
                <h1>Comment</h1>
                <div class="row">
                    <div class="col-12">
                        <label for="name">name</label>
                        <input type="text" class="form-control" name="nameComment">
                    </div>
                    <div class="col-12">
                        <label for="comment">comment</label>
                        <textarea class="form-control" name="comment" id="txtComment" cols="30" rows="10"></textarea>
                    </div>
                    <div class="d-grid col-6 mx-auto">
                        <button class="btn btn-success btn-md" type="submit" name="commentBtn"
                            value="commentBtn">ส่ง</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>