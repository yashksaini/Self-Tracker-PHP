<?php
session_start();
include("../../config.php");
$user_id = $_SESSION["user_id"];
if(isset($_POST["cat_name"])){

    $cat_name= $_POST["cat_name"];
    $query = "SELECT * FROM category WHERE user_id='$user_id' AND cat_name='$cat_name'";
    $result = mysqli_query($con,$query);

    if(mysqli_num_rows($result)==1){
        echo "Category Already Added";
    }
    else{
        $query1 = "INSERT INTO category (user_id,cat_name)VALUES ('$user_id','$cat_name')";
        $result1 = mysqli_query($con,$query1);
        if($result1){
            echo "Category added successfully";
        }
    }
}

?>