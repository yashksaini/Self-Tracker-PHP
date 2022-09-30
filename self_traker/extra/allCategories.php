<?php
session_start();
include("../../config.php");
$user_id = $_SESSION["user_id"];

$query = "SELECT * FROM category WHERE user_id='$user_id' ORDER BY id DESC";
$result = mysqli_query($con,$query);
if(mysqli_num_rows($result)>0){
    $i=0;
    while($row=$result->fetch_assoc()){
        $cat_name = $row["cat_name"];
        $cat_id = $row["id"];
        $i++;
        echo "
        <div class='col-md-4 col-lg-3 col-12 mt-2 mb-2'>
            <div class='card_box'>
                <div data-bs-toggle='modal' data-bs-target='#showCat' onclick='each_sub(\"$cat_id\",\"$cat_name\")'><span>$i</span><span>+</span></div>
                <p>$cat_name</p>
                <button data-bs-toggle='modal' data-bs-target='#edit' onclick='update(\"$cat_id\",\"$cat_name\")'><i class='far fa-edit'></i></button>
            </div>
        </div>";
    }
}
?>
