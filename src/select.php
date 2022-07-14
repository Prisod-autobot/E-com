<?php
    $id = $_POST['id'];
    $outp = '';
    require_once('../config/db_config.php');

     $query = "SELECT * FROM plant WHERE plantid = '$id'";
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));;

    $outp .='<div class="row gy-2 gx-2 p-1">';
while($row = mysqli_fetch_array($result)) {
    
        $outp .='<div class="col-sm img_modal">
                    <img style="max-width:100%;border-radius: 5px;pointer-events: none;" src="src/webp/' .$row['plantjpg1'].'.webp'.'" alt="">
                </div>';
        $outp .='<div class="col-sm img_modal">
                    <img style="max-width:100%;border-radius: 5px;pointer-events: none;" src="src/webp/' .$row['plantjpg2'].'.webp'.'" alt="">
                </div>';
        $outp .='<div class="col-sm img_modal">
                    <img style="max-width:100%;border-radius: 5px;pointer-events: none;" src="src/webp/' .$row['plantjpg3'].'.webp'.'" alt="">
                </div>';
        $outp .='</div>';
        $outp .='
        <div class="container">
            <div class="row">
                <div class="col" style="text-align:center;">
                    <h6 style="font-weight: bold;">ราคา: '.$row['price'].' บาท</h6>
                </div>
                <div class="col" style="text-align:center;">
                    <h6 style="font-weight: bold;">จำนวน: '.$row['numberplant'].' ต้น</h6>
                </div>
            </div>
        </div>
        <div class="col-sm modal_button">
            <p class="modal_p">'.$row['info'].'</p>
        </div>';

}
echo $outp; 
?>
