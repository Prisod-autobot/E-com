<?php
    session_start();
    require_once './config/db_config.php';

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
    <title>TreeHub</title>
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
    <link rel="stylesheet" href="./style/home.css">


</head>

<body unselectable="on" onselectstart="return false;" onmousedown="return false;">
    <!-- navbar -->
    <header id="header">
        <h1 class="ml9">
            <span class="text-wrapper">
                <span onclick="gohome()" class="letters">Prisod.</span>
            </span>
        </h1>
        <div id="toggle"></div>
        <div id="navbar">
            <ul>
                <li><a class="homy" href="admin">Home</a></li>
                <li><a onclick="showAlert()" href="#">Order</a></li>
                <li><a href="form">AddItem</a></li>
                <li><a href="./src/logout">Logout</a></li>
            </ul>
        </div>
    </header>
    <!-- Table -->
    <table>
        <thead>
            <tr>
                <th>Pict</th>
                <th>Name</th>
                <th>Info</th>
                <th>Price</th>
                <th>Number</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>
        </thead>

        <?php
        $sql = "SELECT * FROM plant ORDER BY nameplant";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0) {
            while($row = mysqli_fetch_assoc($result)){
                    ?>
        <tbody>
            <tr>
                <input type="hidden" class="delete_ser" value="<?php echo $row['plantid']?>">
                <td data-label="Name"><img style="width: 50px;height: 50px;" src="src/upload/<?php echo $row['plantjpg1']?>" alt=""/></td>
                <td data-label="Name"><?php echo $row['nameplant']?></td>
                <td data-label="Info"><?php echo $row['info']?></td>
                <td data-label="Price"><?php echo $row['price']?></td>
                <td data-label="Number"><?php echo $row['numberplant']?></td>
                <td data-label="Delete">
                    <button class="btn btn-danger btn-sm">
                        <a class="delete_id" href="./src/delete.php?id=<?php echo $row['plantid'];?>
                        &img1=<?php echo $row['plantjpg1'];?>
                        &img2=<?php echo $row['plantjpg2'];?>
                        &img3=<?php echo $row['plantjpg3'];?>">Delete</a>
                    </button>
                </td>
                <td data-label="Edit">
                    <button class="btn btn-dark btn-sm">
                        <a class="acolor" href="./edit.php?id=<?php echo $row['plantid'];?>">Edit</a>
                    </button>
                </td>
            </tr>
        </tbody>

        <?php }
        }else{
            echo("<th>ไม่มีข้อมูล</th>");
        }
        mysqli_close($conn);
        echo "</table>";
        ?>

        <script>
        /* NAVBAR */
        const header = document.getElementById('header');
        const toggle = document.getElementById('toggle');
        const navbar = document.getElementById('navbar');
        document.onclick = function(e) {
            if (e.target.id !== 'header' && e.target.id !== 'toggle' && e.target.id !== 'navbar') {
                toggle.classList.remove('active');
                navbar.classList.remove('active');
            }
        }
        toggle.onclick = function() {
            toggle.classList.toggle('active');
            navbar.classList.toggle('active');

        }
        $('.delete_id').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href');

            Swal.fire({
                icon: 'warning',
                title: 'ลบข้อมูล?',
                text: 'เมื่อข้อมูลถูกลบจะไม่สามารถกู้คืนได้',
                confirmButtonText: 'Ok',
                showCancelButton: true,
                cancelButtonColor: '#cf142b',
                confirmButtonColor: '#3085d6',

            }).then((result) => {
                if (result.value) {
                    document.location.href = href;
                }
            })
        });

        function gohome() {
            location.href = "admin.php";
        }
        </script>

</body>

</html>

<?php
    }
    ?>