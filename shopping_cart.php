<?php
    session_start();
    require_once './config/db_config.php';
    error_reporting(0);

    $userID = $_SESSION['id'];
    if($_SESSION['id'] == ""){
        header("location: login");
    }else{
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="icon" type="image/svg+xml" href="assets/favicon.svg">

    <!-- all script -->
    <script src="./libs/jquery-3.6.0.min.js"></script>
    <script src="./libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="./libs/sweetalert2.all.min.js"></script>
    <script src="https://kit.fontawesome.com/ece49ec389.js" crossorigin="anonymous"></script>

    <!-- ส่วนเสริม -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="./libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./libs/sweetalert2.min.css">
    <link rel="stylesheet" href="./style/cart_user.css">
</head>

<body>

</body>
<div class="container">
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card m-b-30">
                    <div class="back-home" onclick="window.location.href='member'">
                        <i class="fas fa-arrow-left fa-lg"></i>
                    </div>
                    <div class="card-header">
                        <h5 class="card-title">Cart</h5>

                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-lg-10 col-xl-8">
                                <div class="cart-container">
                                    <div class="cart-head">
                                        <div class="table-responsive">
                                            <table class="table table-borderless" align="center">
                                                <thead>
                                                    <tr>
                                                        <th class="itbeensolong" scope="col">#</th>
                                                        <th class="itbeensolong" scope="col">Photo</th>
                                                        <th class="itbeensolong" scope="col">ชื่อสินค้า</th>
                                                        <th class="itbeensolong" scope="col">จำนวน</th>
                                                        <th class="itbeensolong" scope="col">ราคา</th>
                                                        <th class="itbeensolong" scope="col" class="text-right">Total</th>
                                                        <th class="itbeensolong" scope="col">ลบ</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql = "SELECT * FROM cart WHERE qty ='$userID'";
                                                    $result = mysqli_query($conn, $sql);
                                                    $resultCheck = mysqli_num_rows($result);
                                                    $total_result = 0;
                                                    $i = 1;
                                                    if ($resultCheck > 0) {
                                                        while($row = mysqli_fetch_assoc($result)){
                                                            $total_result += $row['total_price'];
                                                            $qty_p += $row['total_product'];
                                                            $result_total = $total_result + $total_result;
                                                            $num_format = number_format($result_total);
                                                            $qty_fm = number_format($qty_p * 20);
                                                    ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $i ?></th>
                                                        <td><img src="src/webp/<?php echo $row['product_img']?>.webp"
                                                                class="img-fluid" width="35" alt="product"></td>
                                                        <td><?php echo $row['product_name']?></td>
                                                        <input type="hidden" class="id_product"
                                                            value="<?= $row['id']?>">
                                                        <input type="hidden" class="price_product"
                                                            value="<?= $row['product_price']?>">
                                                        <td>
                                                            <div class="form-group mb-0">
                                                                <input min="1" type="number"
                                                                    class="form-control cart-qty" name="cartQty1"
                                                                    id="cartQty1" value="<?= $row['total_product']?>">
                                                            </div>
                                                        </td>
                                                        <td><?php echo $row['product_price']?>฿</td>
                                                        <td class="text-right"><?php echo $row['total_price']?>฿</td>
                                                        <td><a href="src/member_delete.php?remove=<?= $row['id'] ?>"
                                                                class="text-danger"><i class="far fa-trash-alt"></i></a>
                                                        </td>
                                                    </tr>
                                                    <?php $i++; }}
                                                    else{
                                                        echo "ไม่พบข้อมูล";
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="cart-body">
                                        <div class="row">
                                            <div class="col-md-12 order-2 order-lg-1 col-lg-5 col-xl-6">
                                                <div class="order-note">
                                                    <form>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input type="search" class="form-control"
                                                                    placeholder="Coupon Code" aria-label="Search"
                                                                    aria-describedby="button-addonTags">
                                                                <div class="input-group-append">
                                                                    <button class="input-group-text" type="submit"
                                                                        id="button-addonTags">Apply</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            $userID = "SELECT addresscod,alley,street,province,disd,subdist,zip_code,fullname,telephone FROM users_oop WHERE id ='$userID'";
                                                            $result_id = mysqli_query($conn, $userID);
                                                        ?>
                                                        <div class="form-group">
                                                            <label for="specialNotes">ที่อยู่ในการจัดส่ง:</label>
                                                            <span><a style="color:red;"
                                                                    href="editProfile">หากที่อยู่ไม่ถูกต้องคลิกตรงนี้</a></span>
                                                            <?php while($rowID = mysqli_fetch_assoc($result_id)){ 
                                                                
                                                                $result = sprintf("%s-%s-%s",
                                                                substr($rowID['telephone'], 0, 3),
                                                                substr($rowID['telephone'], 3, 3),
                                                                substr($rowID['telephone'], 6, 4));
                                                                ?>
                                                            <textarea class="form-control" name="specialNotes"
                                                                id="specialNotes" rows="3"
                                                                placeholder="<?php echo 'ชื่อ-สกุล ' . $rowID['fullname'] .' | เบอร์ '.$result.' | บ้านเลขที่ '.$rowID['addresscod'].
                                                                ' | ถนน '.$rowID['street'].' | ซอย '.$rowID['alley'].' | ตำบล '.$rowID['subdist'].' | อำเภอ '.
                                                                $rowID['disd'].' | จังหวัด '.$rowID['province'].' | รหัสไปรษณีย์ '.$rowID['zip_code']?>"
                                                                disabled></textarea>
                                                        </div>
                                                        <?php } ?>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-12 order-1 order-lg-2 col-lg-7 col-xl-6">
                                                <div class="order-total table-responsive ">
                                                    <table class="table table-borderless text-right">
                                                        <tbody>
                                                            <tr>
                                                                <td>รวม :</td>
                                                                <td><?php echo number_format($total_result); ?>฿</td>
                                                            </tr>
                                                            <tr>
                                                                <td>ค่าส่ง :</td>
                                                                <td><?php echo $qty_fm;?>฿</td>
                                                            </tr>
                                                            <tr>
                                                                <td>อุปกรณ์(100%) :</td>
                                                                <td><?php echo ($num_format); ?>฿</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="f-w-7 font-18">
                                                                    <h4>รวมทั้งหมด :</h4>
                                                                </td>
                                                                <td class="f-w-7 font-18">
                                                                    <h4><?php echo number_format($result_total + ($qty_p*20)); ?>฿
                                                                    </h4>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cart-footer text-right">
                                    <a href="shopping_cart" class="btn btn-info my-1">Update<i
                                                class="ri-arrow-right-line ml-2"></i></a>
                                        <a href="#" class="btn btn-success my-1">ชำระเงิน<i
                                                class="ri-arrow-right-line ml-2"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End col -->
        </div>
        <!-- End row -->
    </div>
</div>
<script>
$(document).ready(function() {
    $('.cart-qty').on('change', function() {
        var $el = $(this).closest('tr');

        var pid = $el.find(".id_product").val();
        var price = $el.find(".price_product").val();
        var qty = $el.find("#cartQty1").val();
        location.reload(true);
        window.location.href = window.location.href;
        $.ajax({
            url: 'src/badge',
            method: 'POST',
            cache: false,
            data: {
                pid: pid,
                price: price,
                qty: qty
            },
            success: function(response) {
                console.log(response);
                window.location.reload();
            }
        });
    });
});
</script>

</html>
<?php } ?>