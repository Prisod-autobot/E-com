<?php
    session_start();
    include_once('./src/register_db_config.php');
    error_reporting(0);
    $activeNum = $_COOKIE['nom'];
if($activeNum == '1'){
    header("location: member");
}else{
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/svg+xml" href="assets/favicon.svg">

    <!-- all script -->
    <script src="./libs/jquery-3.6.0.min.js"></script>
    <script src="./libs/anime.min.js"></script>
    <script src="./libs/aos.js"></script>
    <script src="./libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="./libs/sweetalert2.all.min.js"></script>
    <script src="https://kit.fontawesome.com/ece49ec389.js" crossorigin="anonymous"></script>

    <!-- ส่วนเสริม -->
    <link rel="stylesheet" href="./libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./libs/sweetalert2.min.css">
    <link rel="stylesheet" href="./style/login.css">

</head>

<body>
    <div class="mw-100">
        <div class="box"></div>
        <div class="box"></div>
        <div class="box"></div>
        <div class="box"></div>
        <div class="box"></div>
        <div class="box"></div>
        <div class="box"></div>
        <div class="box"></div>
        <div class="box"></div>
        <div class="box"></div>
        <!-- navbar -->
        <header id="header">
            <div id="navbar" onclick="window.location.href='index'"><i class="fas fa-angle-left fa-3x"></i></div>
            <h1 class="ml9">
                <span class="text-wrapper">
                    <span onclick="window.location.href='index'" class="letters">Prisod.</span>
                </span>
            </h1>
            <div class="hide_X">X</div>
        </header>
        <!-- LOGIN NEW -->
        <form method="POST">
            <div class="wrapper fadeInDown">
                <div id="formContent">
                    <!-- Tabs Titles -->
                    <h2 class="active"> ล็อกอิน </h2>
                    <h2><a class="inactive underlineHover" href="register"> สร้างบัญชี</a></h2>

                    <!-- Icon -->
                    <div class="fadeIn first">
                        <i class="fas fa-theater-masks fa-5x"></i>
                    </div>

                    <!-- Login Form -->
                    <form>
                        <input type="text" id="username" class="fadeIn second" name="username" placeholder="ชื่อบัญชี"
                            Required>
                        <input type="password" id="password" class="fadeIn third" name="password" placeholder="รหัสผ่าน"
                            Required
                            onkeypress="return (event.charCode >= 35 && event.charCode <=38 || event.charCode >= 40 && event.charCode <=57 || event.charCode >= 64 && event.charCode <=122)">
                        <input type="submit" name="login" id="submit" class="fadeIn fourth" value="ล็อกอิน">
                    </form>

                    <!-- Remind Passowrd -->
                    <div id="formFooter">
                        <a class="underlineHover" href="#">ลืมรหัสผ่าน?</a>
                    </div>

                </div>
                <p data-aos="fade-up" style="text-align:center"
                    class="text-lg-center text-md-center text-sm-center text-xs-center">Copyright
                    &copy;
                    <script>
                    document.write(new Date().getFullYear());
                    </script> Prisod | <i class="fab fa-facebook-f"></i>
                </p>
                <div class="space"></div>
                </p>
            </div>
        </form>
    </div>
</body>

<?php
$userdata = new DB_con();

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $activeStatus = 1;

    $status = $userdata->checkStatus($username,$activeStatus);
    $result = $userdata->signin($username,$password);
    $num = mysqli_fetch_array($result);

    if($num > 0){
        $_SESSION['id'] = $num['id'];
        $_SESSION['fullname'] = $num['fullname'];
        $_SESSION['ulevel'] = $num['ulevel'];

        if($num['ulevel'] == 'a'){
            echo "<script>
            Swal.fire(
                'เข้าสู่ระบบ Admin',
                'Welcome!!!',
                'success'
            ).then(function(){
                window.location = 'admin';
            });
            </script>";
        }else{
            echo "<script>
            Swal.fire(
                'เข้าสู่ระบบ Member',
                'Welcome!!!',
                'success'
            ).then(function(){
                window.location = 'member';
            });
            </script>";
        }

    }else{
        echo "<script>
        Swal.fire(
            'ไม่มีบัญชีในระบบ',
            'รหัสผ่านหรือชื่อบัญไม่ถูกต้อง',
            'error'
        ).then(function(){
            window.location = 'login';
        });
        </script>";
    }
}
?>
<script>
var textWrapper = document.querySelector('.ml9 .letters');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

anime.timeline({
        loop: true
    })
    .add({
        targets: '.ml9 .letter',
        scale: [0, 1],
        duration: 1500,
        elasticity: 600,
        delay: (el, i) => 45 * (i + 1)
    }).add({
        targets: '.ml9',
        opacity: 0,
        duration: 3000,
        easing: "easeOutExpo",
        delay: 3000
    });

AOS.init();
</script>

</html>

<?php } ?>