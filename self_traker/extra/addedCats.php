<?php
session_start();
include("../../config.php");
$user_id = $_SESSION["user_id"];

if(isset($_POST["sub_id"])){
    $sub_id = $_POST["sub_id"];
    $query = "SELECT * FROM category WHERE id IN(SELECT cat_id FROM sub_cat WHERE user_id='$user_id' AND sub_id='$sub_id')";
    $result = mysqli_query($con,$query);

    if(mysqli_num_rows($result)>0){
        while($row=$result->fetch_assoc()){
            $cat_id = $row["id"];
            $cat_name = $row["cat_name"];
            echo "<span onclick='removeCat(\"$cat_id\")'>$cat_name <i class='fas fa-times'></i></span>";
        }
    }
    else{
        echo "<span>No Category added</span>";
    }
}
?>
