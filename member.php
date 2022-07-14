<?php
    session_start();
    require_once './config/db_config.php';
    error_reporting(0);

    $rpp = 28;
//36
    isset($_GET['page']) ? $page = $_GET['page'] : $page = 0;
    if($page > 1){
        $start = ($page * $rpp) - $rpp;
    }else{
        $start = 0;
    }
    if($_SESSION['id'] == ""){
        setcookie('nom','0',time() + 86400,'/');
        header("location: login");
    }else{
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TreeHub</title>
    <link rel="icon" type="image/svg+xml" href="assets/favicon.svg">

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
                    <li><a href="editProfile">Profile</a></li>
                    <li><a target="_blank"
                            href="https://www.facebook.com/%E0%B8%AA%E0%B8%A7%E0%B8%99%E0%B9%81%E0%B8%A1%E0%B9%88%E0%B9%81%E0%B8%95%E0%B8%87-%E0%B8%9E%E0%B8%B1%E0%B8%99%E0%B8%98%E0%B8%B8%E0%B9%8C%E0%B9%84%E0%B8%A1%E0%B9%89-134414710702648">ติดต่อ</a>
                    </li>
                    <li><a href="src/logout">logout</a></li>
                    <li><i onclick="cart()" class='bx bx-cart bx-sm'></i><span class="badge" id="cart_item"></span></li>

                </ul>
            </div>

            <a href="member" class="header__logo">P</a>

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
            while($row = mysqli_fetch_assoc($result)){
        ?>
                <div class="col-6 col-sm-4 col-md-3 px-1" data-aos="fade-up">
                    <div class="card" xid="<?php echo $row['plantid']?>" style="width=180px;">
                        <img src="src/webp/<?php echo $row['plantjpg2']?>.webp" class="card-img-top"
                            alt="<?php echo $row['nameplant']?>">
                        <div class="card-body">
                            <div class="liner"></div>
                            <h5 class="card-title"><?php echo $row['nameplant']?></h5>
                            <p class="card-text"> <?php echo $row['info']?></p>
                            <!--                             <div class="row">
                                <div class="col align-items-center">
                                    <p class="card-aboutP"><?php echo $row['price']?></p>
                                </div>
                                <div class="col align-items-center">
                                    <p class="card-aboutN"><?php echo $row['numberplant']?></p>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <?php
        }
    }?>
                <div class="btn-group">
                    <?php
    if($page < 1 || $page > ceil($total_page)){?>
                    <script>
                    window.location.href = '?page=1'
                    </script>
                    <?php }
    else {
        $x = $page;?>
                    <a href='?page=<?= $x - 1?>'><button type="button" class="btn btn-outline-dark" id="<?= $x?>"><i
                                class="fas fa-arrow-left"></i></button></a>
                    <a href='?page=<?= $x + 1?>'><button type="button" class="btn btn-outline-dark" id="<?= $x?>"><i
                                class="fas fa-arrow-right"></i></button></a>
                    <?php 
    }?>
                </div>
            </div>
        </div>
    </div>
    <p style="text-align:center" class="text-lg-center text-md-center text-sm-center text-xs-center">Copyright &copy;
        <script>
        document.write(new Date().getFullYear());
        </script> Prisod | <i class="fab fa-facebook-f"></i>
    </p>
    <div class="space"></div>
    </p>
    <?php
    mysqli_close($conn);
                ?>

</body>
<script>
/* LOGO */
/*==================== SHOW NAVBAR ====================*/
const showMenu = (headerToggle, navbarId) => {
    const toggleBtn = document.getElementById(headerToggle),
        nav = document.getElementById(navbarId)

    // Validate that variables exist
    if (headerToggle && navbarId) {
        toggleBtn.addEventListener('click', () => {
            // We add the show-menu class to the div tag with the nav__menu class
            nav.classList.toggle('show-menu')
            // change icon
            toggleBtn.classList.toggle('bx-x')
        })
    }
}
showMenu('header-toggle', 'navbar')

/*==================== LINK ACTIVE ====================*/
const linkColor = document.querySelectorAll('.nav__link')

function colorLink() {
    linkColor.forEach(l => l.classList.remove('active'))
    this.classList.add('active')
}

linkColor.forEach(l => l.addEventListener('click', colorLink))
/* FADE Card */
AOS.init();

//SENT DATA TO cart
$(document).ready(function() {
    $('#num_logs').click(function() {
        var cart_id = $(this).val();
        $.ajax({
            url: 'src/shopping_cart',
            method: 'POST',
            data: {
                id: cart_id
            },
            success: function() {
                load_cart_numbers();
                Swal.fire({
                    position: 'top',
                    icon: 'success',
                    title: 'เพิ่มสินค้าเรียบร้อย',
                    text: 'เพิ่มลดสินค้าได้ที่ตะกร้าสินค้า',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        })
    })
    load_cart_numbers();

    function load_cart_numbers() {
        $.ajax({
            url: 'src/badge',
            method: 'GET',
            data: {
                cart_item: "cart_item"
            },
            success: function(response) {
                $("#cart_item").html(response);
            }
        })
    }
});
/* modal open*/
$(document).ready(function() {
    $('.card').click(function() {
        var uid = $(this).attr("xid");
        $.ajax({
            url: './src/member_select.php',
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
            url: './src/member_header.php',
            method: 'post',
            data: {
                id: uid
            },
            success: function(data) {
                $('#exampleModalLabel').html(data);
            }
        });
        $.ajax({
            url: './src/footerModal.php',
            method: 'post',
            data: {
                id: uid
            },
            success: function(data) {
                $('#num_logs').val(data);
            }
        })
    });
});

function cart() {
    window.location.href = 'shopping_cart';
}
</script>

</html>
<?php     
    require_once './src/member_modal.php';
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
            url: 'member_search.php',
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

<?php
    }
    ?>