<?php
include("checkUser.php");
$_SESSION["active_number"] = 4;
$user_id = $_SESSION["user_id"];
function get7DaysDates($days, $format = 'd/m'){
    $m = date("m"); $de= date("d"); $y= date("Y");
    $dateArray = array();
    for($i=0; $i<=$days-1; $i++){
        $dateArray[] = '"' . date($format, mktime(0,0,0,$m,($de-$i),$y)) . '"'; 
    }
    return array_reverse($dateArray);
}
$days = get7DaysDates(7, 'Y-m-d');

?>
<?php echo"$part_top";?>
<link rel="stylesheet" href="styles/subjects.css">
<link rel="stylesheet" href="styles/index.css">

<?php echo"$part_nav";?>
<?php 
// for($i = 0;$i<count($days);$i++){
//     echo "<p>Day - $i _ $days[$i]</p>";
// }
?>
<div class="container-fluid " style="margin-bottom: 100px;">
    <div class="row">
        <div class="col-md-4 mt-2 mb-3" id="f_type">
            <h5 class="mb-3">Select Type</h5>
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
    <div class="row mt-4 mb-4 outer_box" id="show_graph">
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
        url: "extra/showGraph.php",
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
        url: "extra/showGraph.php",
        success: function (data) {
          document.getElementById("show_graph").innerHTML = data;
        },
      });
    }
    
      
    }
</script>
<?php echo"$part_footer";?>