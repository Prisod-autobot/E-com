<?php 
    require_once './src/modal.php';
    require_once './config/db_config.php';

    $movie_name = $_POST['movie_name'];

    $sql = "SELECT * FROM plant WHERE nameplant LIKE '%$movie_name%' ORDER BY nameplant";
    $query = mysqli_query($conn,$sql) or die(mysqli_error($conn));;
    $data='';

    while($row = mysqli_fetch_assoc($query)){
        $data .=  "                
        <div class='col-6 col-sm-4 col-md-3 px-1' data-aos='fade-up' id='hideandseek'>
        <div class='card' xid=" . $row['plantid'] . ">
            <img src=" . 'src/webp/' . $row['plantjpg2'] .".webp" ." class='card-img-top'
                alt=" . $row['nameplant'] . ">
            <div class='card-body'>
                <div class='liner'></div>
                <h5 class='card-title'> ". $row['nameplant'] . "</h5>
                <p class='card-text'> " . $row['info'] ." </p>
            </div>
        </div>
    </div>";
    }
    echo $data;
?>
<script>
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