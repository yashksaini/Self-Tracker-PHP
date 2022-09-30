<?php
include("checkUser.php");
$months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
$_SESSION["active_number"] = 5;
$user_id = $_SESSION["user_id"];
function get7DaysDates($days, $format = 'd/m'){
    $m = date("m"); $de= date("d"); $y= date("Y");
    $dateArray = array();
    for($i=0; $i<=$days-1; $i++){
        $dateArray[] = date($format, mktime(0,0,0,$m,($de-$i),$y)) ; 
    }
    return array_reverse($dateArray);
}
$days = get7DaysDates(30, 'Y-m-d');

?>
<?php echo"$part_top";?>
<link rel="stylesheet" href="styles/subjects.css">
<link rel="stylesheet" href="styles/activity.css">

<?php echo"$part_nav";?>
<?php 
// for($i = 0;$i<count($days);$i++){
//     echo "<p>Day - $i _ $days[$i]</p>";
// }
?>
<div class="container-fluid " style="margin-bottom: 30px;">
    <div class="row">
        <div class="col-md-4 mt-2 mb-3" id="f_type">
            <h5 class="mb-3">Select Type (Last 30 Days Analysis)</h5>
            <input type="radio" name='type' value="1" id="subject" checked class="form-check-input">
            <label for="subject">Subject</label>
            
            <input type="radio" name='type' value="2" id="category" class="form-check-input" style="margin-left: 32px;">
            <label for="category">Category</label>
        </div>
        <div class="col-md-4 mt-2 mb-3" id="select_data">
            
        </div>
        <div class="col-md-4 mt-2 mb-3">
            
        </div>
    </div>
    <div class="row mt-4 mb-0 outer_box" >
        <div id="show_graph"></div>
        <!-- <div class="bar_box">
            <div><span>40</span></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="bar_box1">
            <div>03<span>24</span></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div> -->
    </div>
    <div class="row mt-4 mb-4">
      
      <div class="col-md-4"></div>
      <div class="col-md-4">
      <h5>All Data Entered last 30 Days</h5>
      <?php
      
    for($i=count($days)-1;$i>0;$i--){
      $query = "SELECT * FROM data WHERE user_id='$user_id' AND com_date='$days[$i]'";
      $result = mysqli_query($con,$query);

      $show_days =  explode("-", $days[$i]);
      $show_days = $show_days[2].", ".$months[$show_days[1]-1]."-".$show_days[0];
      echo "<hr/><div class='date'>$show_days</div>";
      if(mysqli_num_rows($result)>0){
        while($row=$result->fetch_assoc()){
          $duration = $row["duration"];
          $sub_id = $row["sub_id"];
          $query1 = "SELECT * FROM subjects WHERE id='$sub_id'";
          $result1 = mysqli_query($con,$query1);
          $row1 = $result1->fetch_assoc();
          $sub_name = $row1["sub_name"];
          echo "<div class='card_box mt-2 mb-2'>
          <i><i>$sub_name</i>  <b>( $duration )</b></i></div>";
        }
      }
      else{
        echo "<p>No data Entered</p>";
      }
    }
      
      ?>
      </div>
      <div class="col-md-4"></div>
    </div>
</div>
<script>
    var l_type = 1;
    $(document).ready(function () {
        let type = 1;
        $.ajax({
        type: "POST",
        data: { type: type },
        url: "extra/showSelects.php",
        success: function (data) {
          document.getElementById("select_data").innerHTML = data;
        },
      });
    });

$(function () {
    $('#f_type input[type=radio]').change(function(){
    //   alert ( $(this).val() ) 
    let type = $(this).val();
    l_type= type;
    document.getElementById("show_graph").innerHTML = "Select an input";
    $.ajax({
        type: "POST",
        data: { type: type },
        url: "extra/showSelects.php",
        success: function (data) {
          document.getElementById("select_data").innerHTML = data;
        },
      });
      
    });
});


</script>
<script>
    function getval(){
    let type = l_type;
    console.log(type);
    if(type==1){
        let id = document.getElementById("select_id").value;
        console.log(id,"IDs");
        $.ajax({
        type: "POST",
        data: { type: type ,id:id},
        url: "extra/show30Graph.php",
        success: function (data) {
          document.getElementById("show_graph").innerHTML = data;
        },
      });
    }else{
        let id = document.getElementById("select_id1").value;
        console.log(id,"IDc");
        $.ajax({
        type: "POST",
        data: { type: type ,id:id},
        url: "extra/show30Graph.php",
        success: function (data) {
          document.getElementById("show_graph").innerHTML = data;
        },
      });
    }
    
      
    }
</script>
<?php echo"$part_footer";?>