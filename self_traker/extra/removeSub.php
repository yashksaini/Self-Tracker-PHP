<?php
session_start();
include("../../config.php");
$user_id = $_SESSION["user_id"];

if(isset($_POST["sub_id"])){
    $sub_id = $_POST["sub_id"];
    $cat_id = $_POST["cat_id"];
    $query = "DELETE FROM sub_cat WHERE sub_id ='$sub_id' AND cat_id='$cat_id' AND user_id='$user_id'";
    $result = mysqli_query($con,$query);

    if($result){
        echo "Removed";
    }
}
?>
