<?php
session_start();
include("../../config.php");
$user_id = $_SESSION["user_id"];

if(isset($_POST["cat_id"])){
    $sub_id = $_POST["sub_id"];
    $cat_id = $_POST["cat_id"];
    $query = "INSERT INTO sub_cat (sub_id,cat_id,user_id) VALUES ('$sub_id','$cat_id','$user_id')";
    $result = mysqli_query($con,$query);

    if($result){
        echo "Added";
    }
}
?>
