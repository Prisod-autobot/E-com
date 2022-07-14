<meta charset="UTF-8">
<?php
    require_once('../config/db_config.php');
    session_start();
    error_reporting(0);

    $id = $_SESSION['id'];
    $query = mysqli_query($conn, "SELECT * FROM users_oop WHERE id = '$id'");
    $resultad = mysqli_fetch_array($query);

    if($_SESSION['id'] == ""){
        header("location: ./login");
    }
    else if($resultad['ulevel'] != "a"){
        header("location: ./member");
    }
    else{


    $namex = $_POST['name'];
    $info = $_POST['info'];
    $price = $_POST['price'];
    $number = $_POST['number'];

    $fileupload1 = $_POST['fileupload1'];
    $fileupload2 = $_POST['fileupload2'];
    $fileupload3 = $_POST['fileupload3'];

    date_default_timezone_set('Asia/Bangkok');
    $date = date('Y-m-d');

    $run1 = rand();
    $run2 = rand();
    $run3 = rand();

    $countX = "(1)";
    $countY = "(2)";
    $countZ = "(3)";

    $upload1 = $_FILES['fileupload1'];
    $upload2 = $_FILES['fileupload2'];
    $upload3 = $_FILES['fileupload3'];

    $target_dir = "uploads/";
    $target_file1 = $target_dir . basename($_FILES["fileupload1"]["name"]);
    $target_file2 = $target_dir . basename($_FILES["fileupload2"]["name"]);
    $target_file3 = $target_dir . basename($_FILES["fileupload3"]["name"]);

    $imageFileType1 = strtolower(pathinfo($target_file1,PATHINFO_EXTENSION));
    $imageFileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));
    $imageFileType3 = strtolower(pathinfo($target_file3,PATHINFO_EXTENSION));

    if (file_exists($target_file)) {
        header("Location: ../admin.php?canNotRead");
    }
    elseif($_FILES['fileupload1']['size'] > 10000000 && $_FILES['fileupload2']['size'] > 10000000 && $_FILES['fileupload3']['size'] > 10000000){
        header("Location: ../admin.php?errorFilesize");
    }
    elseif($imageFileType1 != "jpg" && $imageFileType1 != "png" && $imageFileType2 != "jpg" && $imageFileType2 != "png" && $imageFileType3 != "jpg" && $imageFileType3 != "png"){
            header("Location: ../admin.php?errorTypeFiles");
    }
    else{
        if($upload1 != '' && $upload2 != '' && $upload3 != ''){

            $path1 = "upload/";
            $path2 = "upload/";
            $path3 = "upload/";

            $type1 = strrchr($_FILES['fileupload1']['name'],".");
            $type2 = strrchr($_FILES['fileupload2']['name'],".");
            $type3 = strrchr($_FILES['fileupload3']['name'],".");

            $newname1 = $date.$namex.$countX.$type1;
            $newname2 = $date.$namex.$countY.$type2;
            $newname3 = $date.$namex.$countZ.$type3;

            $path_copy1 = $path1.$newname1;
            $path_copy2 = $path2.$newname2;
            $path_copy3 = $path3.$newname3;

            $path_link1 = "upload/".$newname1;
            $path_link2 = "upload/".$newname2;
            $path_link3 = "upload/".$newname3;

            move_uploaded_file($_FILES['fileupload1']['tmp_name'],$path_copy1);
            move_uploaded_file($_FILES['fileupload2']['tmp_name'],$path_copy2);
            move_uploaded_file($_FILES['fileupload3']['tmp_name'],$path_copy3);
        }else{
            echo "<script>console.log('error'); </script>";
        }
    $sql = "INSERT INTO plant (nameplant, info, price, numberplant, plantjpg1, plantjpg2, plantjpg3) VALUES ('$namex', '$info', '$price', '$number', '$newname1', '$newname2', '$newname3');";
    /* mysqli_query($conn, $sql); */
    
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    
    if($result){
        header("Location: ../admin.php?Insert Success");
    }else{
        echo "<script>
            alert('error');
        </script>";
    }
}
}
?>