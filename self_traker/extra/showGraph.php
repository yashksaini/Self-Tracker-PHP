<?php
session_start();
include("../../config.php");
$user_id = $_SESSION["user_id"];

function get7DaysDates($days, $format = 'd/m'){
    $m = date("m"); $de= date("d"); $y= date("Y");
    $dateArray = array();
    for($i=0; $i<=$days-1; $i++){
        $dateArray[] = date($format, mktime(0,0,0,$m,($de-$i),$y)); 
    }
    return array_reverse($dateArray);
}
$days = get7DaysDates(7, 'Y-m-d');
$all_dates = Get7DaysDates(7,'d');
$all_months = Get7DaysDates(7,'m');
    if(isset($_POST["id"])){
        $type = $_POST["type"];
        $id = $_POST["id"];
        if($type==1){
            $query1 = "SELECT * FROM subjects WHERE id='$id'";
            $result1 = mysqli_query($con,$query1);
            $row = $result1->fetch_assoc();
            $sub_name = $row["sub_name"];
            echo "Subject - $sub_name";
        }
        else{
            $query1 = "SELECT * FROM category WHERE id='$id'";
            $result1 = mysqli_query($con,$query1);
            $row = $result1->fetch_assoc();
            $cat_name = $row["cat_name"];
            echo "Category - $cat_name";
        }
        
        if($type=="1"){
            $all_duration = array();
            for($i=0;$i<count($days);$i++){
                $query = "SELECT SUM(duration) AS total,date,month,year FROM data WHERE sub_id='$id' AND user_id='$user_id' AND com_date ='$days[$i]' GROUP BY date,month,year";
                $result = mysqli_query($con,$query);
                $row = $result->fetch_assoc();
                if(mysqli_num_rows($result)>0){
                    $duration = $row["total"];
                    array_push($all_duration,$duration);
                }
                else{
                    array_push($all_duration,0);
                }
                
            }
            // Function to Draw Graph
            $max = max($all_duration);
            
            echo "<div class='bar_box'>";
            for($i=0;$i<count($days);$i++){
                // echo "$all_duration[$i] - $max";
                if($max!=0){
                    $value = (300/$max)*$all_duration[$i];
                    $value = $value."px";
                }
                else{
                    $value = "0px";
                }
                
                echo "<div style='height:$value'><span >$all_duration[$i]</span></div>";
            }
            echo "</div><div class='bar_box1'>";
            for($i=0;$i<7;$i++){
                echo "<div>$all_dates[$i]<span>$all_months[$i]</span></div>";
            }
            echo "</div>";

        }
        else{
            $all_duration1 = array();
            for($i=0;$i<count($days);$i++){
                $query = "SELECT SUM(duration) AS total,date,month,year FROM data WHERE user_id='$user_id' AND com_date ='$days[$i]' AND sub_id IN( SELECT sub_id FROM sub_cat WHERE cat_id=$id) GROUP BY date,month,year";
                $result = mysqli_query($con,$query);
                $row = $result->fetch_assoc();
                if(mysqli_num_rows($result)>0){
                    $duration = $row["total"];
                    array_push($all_duration1,$duration);
                }
                else{
                    array_push($all_duration1,0);
                }
                
            }
            // Function to Draw Graph
            $max = max($all_duration1);
            
            echo "<div class='bar_box'>";
            for($i=0;$i<count($days);$i++){
                // echo "$all_duration[$i] - $max";
                if($max!=0){
                    $value = (300/$max)*$all_duration1[$i];
                    $value = $value."px";
                }
                else{
                    $value = "0px";
                }
                
                echo "<div style='height:$value'><span >$all_duration1[$i]</span></div>";
            }
            echo "</div><div class='bar_box1'>";
            for($i=0;$i<7;$i++){
                echo "<div>$all_dates[$i]<span>$all_months[$i]</span></div>";
            }
            echo "</div>";

        }
    }
    else{
        echo "Please Select Any Option";
    }
    
?>
