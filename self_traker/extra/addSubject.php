<?php
session_start();
include("../../config.php");
$user_id = $_SESSION["user_id"];
if(isset($_POST["sub_name"])){

    $sub_name= $_POST["sub_name"];
    $query = "SELECT * FROM subjects WHERE user_id='$user_id' AND sub_name='$sub_name'";
    $result = mysqli_query($con,$query);

    if(mysqli_num_rows($result)==1){
        echo "Subject Already Added";
    }
    else{
        $query1 = "INSERT INTO subjects (user_id,sub_name)VALUES ('$user_id','$sub_name')";
        $result1 = mysqli_query($con,$query1);
        if($result1){
            echo "Subject added successfully";
        }
    }
}

?>