<?php
require_once './config/db_config.php';
error_reporting(0);
$activeNum = $_COOKIE['nom'];
$rpp = 28;
//36
isset($_GET['page']) ? $page = $_GET['page'] : $page = 0;
if($page > 1){
    $start = ($page * $rpp) - $rpp;
}else{
    $start = 0;
}
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
    <link rel="icon" type="image/svg+xml" href="assets/favicon.svg">
    <title>TreeHub</title>

    <!-- all script -->
    <script src="./libs/jquery-3.6.0.min.js"></script>
    <script src="./libs/anime.min.js"></script>
    <script src="./libs/aos.js"></script>
    <script src="./libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="./libs/sweetalert2.all.min.js"></script>
    <script src="https://kit.fontawesome.com/ece49ec389.js" crossorigin="anonymous"></script>
    <script src="./src/index.js"></script>

    <!-- ส่วนเสริม -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="./libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./libs/sweetalert2.min.css">
    <link rel="stylesheet" href="./style/home.css">

</head>

<body unselectable="on" onselectstart="return false;">
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>

    <!--========== HEADER ==========-->
    <header class="header" id="myHeader">
        <div class="header__container">
            <img src="assets/user-regular.svg" alt="" class="header__img" id="menu_X">
            <div class="menu_X">
                <ul>
                    <h6>Account</h6>
                    <li><a class="hor" href="login">login</a></li>
                    <li><a href="register">Register</a></li>
                    <li><a target="_blank"
                            href="https://www.facebook.com/%E0%B8%AA%E0%B8%A7%E0%B8%99%E0%B9%81%E0%B8%A1%E0%B9%88%E0%B9%81%E0%B8%95%E0%B8%87-%E0%B8%9E%E0%B8%B1%E0%B8%99%E0%B8%98%E0%B8%B8%E0%B9%8C%E0%B9%84%E0%B8%A1%E0%B9%89-134414710702648">ติดต่อ</a>
                    </li>
                    <li><i onclick="showAlert();" class='bx bx-cart bx-sm'></i><span class="badge">0</span></li>
                </ul>
            </div>

            <a href="index" class="header__logo">P</a>

            <div class="header__search">
                <input type="search" placeholder="Search" class="header__input" id="searchLive">
                <i class='bx bx-search header__icon'></i>
            </div>

            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>
        </div>
    </header>

    <!--========== NAV ==========-->
    <div class="wideX">
        <!-- Card -->
        <?php
        $result_set = $conn->query("SELECT plantid FROM plant");
        $numRow = $result_set->num_rows;
        $sql = "SELECT * FROM plant ORDER BY nameplant LIMIT $start,$rpp";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));;
        $resultCheck = mysqli_num_rows($result);

        $total_page = $numRow / $rpp;
        if ($resultCheck > 0) {
        ?>
        <div class="container my-5">
            <div class="row mx-n1 g-3" id="showLive">
                <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $postID = $row["plantid"];
                    ?>
                <div class="col-6 col-sm-4 col-md-3 px-1" data-aos="fade-up">
                    <div class="card" xid="<?php echo $row['plantid'] ?>" style="width=180px;">
                        <img src="src/webp/<?php echo $row['plantjpg2'] ?>.webp" class="card-img-top"
                            alt="<?php echo $row['nameplant'] ?>">
                        <div class="card-body">
                            <div class="liner"></div>
                            <h5 class="card-title"><?php echo $row['nameplant']?></h5>
                            <p class="card-text"> <?php echo $row['info'] ?></p>
                        </div>
                    </div>
                </div>
                <?php
                    }
                }?>
                <div class="btn-group">
                    <?php
                    if($page < 1 || $page > ceil($total_page)){?>
                        <script>window.location.href = '?page=1'</script>
                    <?php }
                    else {
                        $x = $page;?>
                    <a href='?page=<?= $x - 1?>'><button type="button" class="btn btn-outline-dark"
                            id="<?= $x?>"><i class="fas fa-arrow-left"></i></button></a>
                    <a href='?page=<?= $x + 1?>'><button type="button" class="btn btn-outline-dark"
                            id="<?= $x?>"><i class="fas fa-arrow-right"></i></button></a>
                    <?php 
                    }?>
                </div>
            </div>
        </div>
    </div>
    <p style="text-align:center" class="text-lg-center text-md-center text-sm-center text-xs-center">Copyright
        &copy;
        <script>
        document.write(new Date().getFullYear());
        </script> Prisod | <i class="fab fa-facebook-f"></i>
    </p>
    <div class="space"></div>
    </p>
    <?php mysqli_close($conn); ?>
</body>
<script>
/* TEST Modal Alert */
function showAlert() {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.resumeTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    Toast.fire({
        icon: 'warning',
        title: 'ล็อกอินก่อน'
    });
}
/* FADE Card */
AOS.init({
    once: true,
    mirror: false
});

/* modal open*/

$(document).ready(function() {
    $('.card').click(function() {
        var uid = $(this).attr("xid");
        $.ajax({
            url: './src/select.php',
            method: "post",
            data: {
                id: uid
            },
            success: function(data) {
                $('#detail').html(data);
                $('#openModal').modal('show');
            }
        });
        $.ajax({
            url: './src/headModal.php',
            method: 'post',
            data: {
                id: uid
            },
            success: function(data) {
                $('#exampleModalLabel').html(data);
            }
        })
    });
});
</script>

</html>
<?php 
    require_once './src/modal.php';
?>
<script type="text/javascript">
// navbar sticky top navigation
$(window).scroll(function() {
    if ($(this).scrollTop() > 0) {
        $('.header').addClass("sticky");
    } else {
        $('.header').removeClass("sticky");
    }
})
// Tab Register Login

const menu_X = document.getElementById("menu_X");
const header__img = document.querySelector('.header__img');
const menuLogin = document.querySelector('.menu_X');
document.onclick = function(e) {
    if (e.target.id !== "menu_X") {
        menuLogin.classList.remove("active");
        header__img.classList.remove("header_active");
    } else {
        menuLogin.classList.toggle("active");
        header__img.classList.toggle("header_active");
    }
}

/* IMG */
$("img").mousedown(function() {
    return false;
});
// LIVE SEARCH
$(document).ready(function() {
    $('#searchLive').on("keyup", function() {
        var getMovieName = $(this).val();
        $.ajax({
            method: 'POST',
            url: 'search.php',
            data: {
                movie_name: getMovieName
            },
            success: function(response) {
                $("#showLive").html(response);
            }
        });
    });
});
// bar path 
</script>
<?php } ?>