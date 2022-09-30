<?php
session_start();
include("../../config.php");
$user_id = $_SESSION["user_id"];
    if(isset($_POST["type"])){
        $type = $_POST["type"];
        if($type=="1"){
            echo "
            <h5 class='mb-3'>Select Subject</h5>
            <select class='form-control mb-3' required name='id' id='select_id' onchange='getval();'>
            <option value='' hidden>Select Subject</option>";
            $query = "SELECT * FROM subjects WHERE user_id='$user_id' AND active='1'";
            $result= mysqli_query($con,$query);
            if(mysqli_num_rows($result)>0){
                while($row=$result->fetch_assoc()){
                    $sub_name = $row["sub_name"];
                    $sub_id = $row["id"];
                    echo "<option value='$sub_id'>$sub_name</option>";
                }
            }
            echo "</select>";
        }
        else{
            echo "
            <h5 class='mb-3'>Select Category</h5>
            <select class='form-control mb-3' required name='id' id='select_id1' onchange='getval();'>
            <option value='' hidden>Select Category</option>";
            $query = "SELECT * FROM category WHERE user_id='$user_id'";
            $result= mysqli_query($con,$query);
            if(mysqli_num_rows($result)>0){
                while($row=$result->fetch_assoc()){
                    $cat_name = $row["cat_name"];
                    $cat_id = $row["id"];
                    echo "<option value='$cat_id'>$cat_name</option>";
                }
            }
            echo "</select>";
        }
    }
    
?>
