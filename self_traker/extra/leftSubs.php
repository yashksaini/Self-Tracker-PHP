<?php
session_start();
include("../../config.php");
$user_id = $_SESSION["user_id"];

if(isset($_POST["cat_id"])){
    $cat_id = $_POST["cat_id"];
    $query = "SELECT * FROM subjects WHERE user_id='$user_id' AND id NOT IN(SELECT sub_id FROM sub_cat WHERE user_id='$user_id' AND cat_id='$cat_id')";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0){
        while($row=$result->fetch_assoc()){
            $sub_id = $row["id"];
            $sub_name = $row["sub_name"];
            echo "<span onclick='addSub(\"$sub_id\")'>$sub_name <i class='fas fa-plus'></i></span>";
        }
    }
    else{
        echo "<span>No Subject Left</span>";
    }
}
?>
