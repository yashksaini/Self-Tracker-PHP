<?php
session_start();
include("../../config.php");
$user_id = $_SESSION["user_id"];

$query = "SELECT * FROM subjects WHERE user_id='$user_id' ORDER BY id DESC";
$result = mysqli_query($con,$query);
if(mysqli_num_rows($result)>0){
    $i=0;
    while($row=$result->fetch_assoc()){
        $sub_name = $row["sub_name"];
        $sub_id = $row["id"];
        $status = $row["active"];
        $color= "#00C55C";
        if($status==2){
            $color = "#DC373D";
        }
        $i++;
        echo "
        <div class='col-md-4 col-lg-3 col-12 mt-2 mb-2'>
            <div class='card_box'>
                <h1 class='show_active' style='background-color:$color'></h1>
                <div data-bs-toggle='modal' data-bs-target='#showSub' onclick='each_sub(\"$sub_id\",\"$sub_name\")'><span>$i</span><span>+</span></div>
                <p>$sub_name</p>
                <button data-bs-toggle='modal' data-bs-target='#edit' onclick='update(\"$sub_id\",\"$sub_name\",\"$status\")'><i class='far fa-edit'></i></button>
            </div>
        </div>";
    }
}
?>
