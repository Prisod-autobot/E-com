<?php
    include_once('./src/register_db_config.php');

    $userdata = new DB_con();
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
    <title>Register</title>
    <link rel="icon" type="image/svg+xml" href="assets/favicon.svg">

    <!-- all script -->
    <script src="./libs/jquery-3.6.0.min.js"></script>
    <script src="./libs/anime.min.js"></script>
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

        <!-- ส่วน register -->
        <form method="POST">
            <div class="wrapper fadeInDown">
                <div id="formContent">
                    <!-- Tabs Titles -->
                    <h2><a class="inactive underlineHover" href="login"> ล็อกอิน </a> </h2>
                    <h2 class="active">สร้างบัญชี </h2>

                    <!-- Icon -->
                    <div class="fadeIn first">
                        <i class="fas fa-at fa-5x"></i>
                    </div>

                    <!-- Login Form -->
                    <form autocomplete="off">
                        <input type="text" id="username" class="fadeIn second" name="username" placeholder="ชื่อบัญชี"
                            onblur="checkusername(this.value)" Required
                            onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57)"></br>
                        <span id="usernameavailable"></span>
                        <input type="email" id="email" class="fadeIn second" name="email" placeholder="อีเมลล์"
                            onblur="checkemail(this.value)" Required
                            onkeypress="return (event.charCode >= 64 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57)"></br>
                        <span id="emailavailable"></span>
                        <input type="password" id="password" class="fadeIn second" name="password"
                            placeholder="รหัสผ่าน" Required
                            onkeypress="return (event.charCode >= 35 && event.charCode <=38 || event.charCode >= 40 && event.charCode <=57 || event.charCode >= 64 && event.charCode <=122)">
                        <input type="password" id="password_confirm" class="fadeIn second" name="password_confirm"
                            placeholder="ยืนยันรหัสผ่าน" Required
                            onkeypress="return (event.charCode >= 35 && event.charCode <=38 || event.charCode >= 40 && event.charCode <=57 || event.charCode >= 64 && event.charCode <=122)">
                        <input type="submit" name="register" id="submit" class="fadeIn fourth" value="สร้างบัญชี">
                    </form>
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
    <?php
    if(isset($_POST['register'])){
        $username = $_POST['username'];
        $useremail = $_POST['email'];
        $password = md5($_POST['password']);
        $password_confirm = $_POST['password_confirm'];

        if($_POST['password'] !== $_POST['password_confirm']){
            echo "<script>
            Swal.fire(
                'รหัสผ่านไม่ตรงกัน',
                'กรุณาลองอีกครั้ง',
                'error'
            );
            </script>";
        }else{
            $sql = $userdata->registration($username,$useremail,$password);
            if($sql){
                echo "<script>
                Swal.fire(
                    'ลงทะเบียนเรียบร้อย',
                    'กดปุ่มเพื่อกลับหน้าล็อกอิน',
                    'success'
                ).then(function(){
                    window.location = 'login.php';
                });
                </script>";
            }else{
                echo "<script>
                Swal.fire(
                    'เกิดข้อผิดพลาดที่ไม่ทราบสาเหตุ',
                    'Host not responding',
                    'error'
                ).then(function(){
                    window.location = 'register.php';
                });
                </script>";
            }
        }
    }
?>
    <script>
    //input 
    function input() {}
    /* LOGO */
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
    /* NAVBAR */
    function checkusername(val) {
        $.ajax({
            type: 'POST',
            url: './src/checkuser_available.php',
            data: 'username=' + val,
            success: function(data) {
                $('#usernameavailable').html(data);
            }
        });
    }

    function checkemail(val) {
        $.ajax({
            type: 'POST',
            url: './src/checkmail_available.php',
            data: 'email=' + val,
            success: function(data) {
                $('#emailavailable').html(data);
            }
        });
    }

    function gohome() {
        location.href = "index";
    }
    </script>
</body>

</html>

<?php } ?>