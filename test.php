<?php
    require_once './config/db_config.php';
    $sql = "SELECT plantid,plantjpg1,plantjpg2,plantjpg3 FROM plant";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));;
    $resultCheck = mysqli_num_rows($result);
    $key = ".jpg";
    $newp = ".webp";
    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['plantid'];
            $webp1 =   basename(($row['plantjpg1']),$newp);
            $webp2 =   basename(($row['plantjpg2']),$newp);
            $webp3 =   basename(($row['plantjpg3']),$newp);

            $new_name1 = $webp1;
            $new_name2 = $webp2;
            $new_name3 = $webp3;
            echo $new_name1;
            // $qy = "UPDATE plant SET plantjpg1='$new_name1',plantjpg2='$new_name2',plantjpg3='$new_name3' WHERE plantid='$id'";
            // $data = mysqli_query($conn, $qy);
            // if($data) {
            //     header("Location:index");
            // }
        }
    }
    mysqli_close($conn);
?>