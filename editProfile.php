<?php
    session_start();
    require_once './config/db_config.php';

    error_reporting(0);

    if($_SESSION['id'] == ""){
        header("location: login.php");
    }else{
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="icon" type="image/svg+xml" href="assets/favicon.svg">

    <script src="./libs/jquery-3.6.0.min.js"></script>
    <script src="./libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="./libs/sweetalert2.all.min.js"></script>
    <script src="./libs/aos.js"></script>
    <script src="https://kit.fontawesome.com/ece49ec389.js" crossorigin="anonymous"></script>

    <!-- ส่วนเสริม -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="./libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./libs/sweetalert2.min.css">
    <link rel="stylesheet" href="./style/editProfile.css">
</head>

<body>
    <?php
    $id = $_SESSION['id'];
    $query = mysqli_query($conn, "SELECT * FROM users_oop WHERE id = '$id'");
    $row = mysqli_fetch_array($query);

    $sql_provinces = "SELECT * FROM provinces";
    $query = mysqli_query($conn, $sql_provinces);
?>

    <div class="container">
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
        <div class="row gutters">
            <div class="card h-100 px-3 py-3 gx-5 px-5" data-aos="fade-up">
                <div class="back-home" onclick="window.location.href='member'">
                    <i class="fas fa-arrow-left fa-lg"></i>
                </div>
                <h2>แก้ไขข้อมูลส่วนตัว</h2>
                <div class="profile">
                    <i class="fas fa-user-cog fa-7x"></i>
                </div>
                <form action="" method="POST">
                    <div class="form-group">
                        <div class="row gy-4">
                            <div class="col col-12">
                                <label for="sel1">ชื่อบัญชี:</label>
                                <input disabled class="form-control" type="username" name=""
                                    value="<?php echo $row['username'] ?>">
                            </div>
                            <div class="col col-12">
                                <label for="sel1">E-mail:</label>
                                <input disabled class="form-control" type="email" name="street"
                                    value="<?php echo $row['useremail'] ?>">
                            </div>
                            <div class="col col-12">
                                <label for="sel1">ชื่อผู้ใช้:</label>
                                <input Required class="form-control" type="username" name="fullName"
                                    value="<?php echo $row['fullname'] ?>">
                            </div>
                            <div class="col col-12">
                                <label for="sel1">เบอร์โทรที่ติดต่อได้:</label>
                                <input Required class="form-control" type="telephone" maxlength="10" name="telephone"
                                    value="<?php echo $row['telephone'] ?>">
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label for="sel1">บ้านเลขที่/หมู่:</label>
                                <input class="form-control" type="address" name="address" value="">
                            </div>
                            <div class="col-6">
                                <label for="sel1">ซอย:</label>
                                <input class="form-control" type="text" name="alley" value="">
                            </div>
                            <div class="col-6">
                                <label for="sel1">ถนน:</label>
                                <input class="form-control" type="text" name="street" value="">
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label for="sel1">จังหวัด:</label>
                                <select class="form-control" name="Ref_prov_id" id="province">
                                    <option value="" selected disabled>-กรุณาเลือกจังหวัด-</option>
                                    <?php foreach ($query as $provinces) { ?>
                                    <option value="<?=$provinces['name_th']?>"><?=$provinces['name_th']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label for="sel1">อำเภอ:</label>
                                <select class="form-control" name="Ref_dist_id" id="amphures">
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label for="sel1">ตำบล:</label>
                                <select class="form-control" name="Ref_subdist_id" id="districts">
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label for="sel1">รหัสไปรษณีย์:</label>
                                <input type="text" name="zip_code" id="zip_code" class="form-control">
                            </div>
                        </div>
                        <div class="d-grid col-6 mx-auto">
                            <button class="btn btn-success btn-md" type="submit" name="update"
                                value="Update">บันทึก</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<script type="text/javascript">
AOS.init();
// เลือกจังหวัด
$(document).ready(function() {
    $('#province').change(function() {
        var name_th = $(this).val();

        $.ajax({
            type: "POST",
            url: "src/ajaxProvince.php",
            data: {
                name_th: name_th,
                function: 'provinces'
            },
            success: function(data) {
                $('#amphures').html(data);
                $('#districts').html(' ');
                $('#zip_code').val(' ');
            }
        });
    });

    $('#amphures').change(function() {
        var name_th = $(this).val();
        $.ajax({
            type: "POST",
            url: "src/ajaxProvince.php",
            data: {
                name_th: name_th,
                function: 'amphures'
            },
            success: function(data) {
                $('#districts').html(data);
                $('#zip_code').val('');
            }
        });
    });
    $('#districts').change(function() {
        var name_th = $(this).val();

        $.ajax({
            type: "POST",
            url: "src/ajaxProvince.php",
            data: {
                name_th: name_th,
                function: 'districts'
            },
            success: function(data) {
                $('#zip_code').val(data)
            }
        });
    });
})
</script>

<?php
if(isset($_POST['update'])){
    $fullName = $_POST['fullName'];
    $telephone = $_POST['telephone'];
    $address = $_POST['address'];
    $alley = $_POST['alley'];
    $street = $_POST['street'];
    $province = $_POST['Ref_prov_id'];
    $disd = $_POST['Ref_dist_id'];
    $subdist = $_POST['Ref_subdist_id'];
    $zip_code = $_POST['zip_code'];

    $sql = "UPDATE users_oop SET fullname = '$fullName', addresscod = '$address', alley = '$alley', 
    street = '$street', province = '$province', disd = '$disd', subdist = '$subdist', zip_code = '$zip_code', telephone = '$telephone' WHERE id='$id'";
    $data = mysqli_query($conn,$sql) or die(mysqli_error($conn));

    if($data){
        echo "<script>Swal.fire(
            'บันทึกข้อมูลแล้ว',
            'กดปุ่มเพื่อกลับหน้าหลัก',
            'success'
        ).then(function(){
            window.location = 'member';
        });
        </script>";
    }else{
        echo "<script>Swal.fire('ข้อมูลผิดพลาด');</script>";
    }

    mysqli_close($conn);
}
    }
?>