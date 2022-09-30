<?php
include("checkUser.php");
$_SESSION["active_number"] = 1;
$user_id = $_SESSION["user_id"];

if(isset($_POST["sub_id"])){
    $sub_id = $_POST["sub_id"];
    $duration = $_POST["duration"];
    $date = date('d');
    $month = date('m');
    $year = date('Y');
    $com_date = date('Y-m-d');
    $query = "INSERT INTO data (date,month,year,com_date,user_id,sub_id,duration) VALUES ('$date','$month','$year','$com_date','$user_id','$sub_id','$duration')";
    $result = mysqli_query($con,$query);
}
if(isset($_POST["rem_id"])){
    $rem_id = $_POST["rem_id"];
    $query = "DELETE FROM data WHERE id='$rem_id'";
    $result = mysqli_query($con,$query);

}


?>
<?php echo"$part_top";?>
<link rel="stylesheet" href="styles/subjects.css">
<style>
    .fa-times:hover{
        color: #DC373D;
        cursor: pointer;
    }
</style>
<?php echo"$part_nav";?>
<div class="container mt-4 mb-4">
    <div class="row">
        <div class="col-md-6 mt-3 mb-3">
            <h4 class="mb-4" style="text-align: center;">Add Entries of today</h4>
            <form method="POST">
                <label class="form-label"><b>Select Subject</b></label>
                <select class="form-control mb-3" required name="sub_id">
                    <option value='' hidden>Select Subject</option>
                    <?php
                        $query = "SELECT * FROM subjects WHERE user_id='$user_id' AND active='1'";
                        $result= mysqli_query($con,$query);
                        if(mysqli_num_rows($result)>0){
                            while($row=$result->fetch_assoc()){
                                $sub_name = $row["sub_name"];
                                $sub_id = $row["id"];
                                echo "<option value='$sub_id'>$sub_name</option>";
                            }
                        }
                    ?>
                </select>
                <label class="form-label"><b>Duration</b> (in minutes)</label>
                <?php
                    $date = date('d');
                    $month = date('m');
                    $year = date('Y');
                    $query = "SELECT SUM(duration) AS total_duration FROM data WHERE date='$date' AND month='$month' AND year='$year' AND user_id='$user_id'";
                    $result = mysqli_query($con,$query);
                    $row = $result->fetch_assoc();
                    $total = $row["total_duration"];
                    $total = 1440 - $total;
                    echo "<span class='float-end'>Time Left: $total </span>";
                    echo "<input type='number' min='5' step='5' max='$total' class='form-control mb-3' placeholder='Duration in minutes.. ' required name='duration'/>" ;
                ?>
                <button class="btn btn-primary mb-2" style="width: 100%;">Add</button>
            </form>
        </div>
        <div class="col-md-6 mt-3 mb-3">
            <h4 class="mb-4">Added Data of Today</h4>
            <?php
                $date = date('Y-m-d');
                $query = "SELECT * FROM data WHERE user_id='$user_id' AND com_date='$date'";
                $result = mysqli_query($con,$query);
                if(mysqli_num_rows($result)>0){
                    while($row=$result->fetch_assoc()){
                        $sub_id = $row["sub_id"];
                        $id = $row["id"];
                        $duration = $row["duration"];
                        $query1 = "SELECT * FROM subjects WHERE id='$sub_id'";
                        $result1 = mysqli_query($con,$query1);
                        $row1= $result1->fetch_assoc();
                        $sub_name = $row1["sub_name"];
                        echo "<div class='card_box mt-2 mb-2'>
                        <i><i>$sub_name</i>  <b>( $duration )</b></i>
                        <i class='fas fa-times' onclick='removeData(\"$id\")'></i>
                        </div>";
                    }
                }
                else{
                    echo "No entries for today";
                }

            ?>
        </div>
    </div>
</div>
<script>
    function removeData(a){
        let rem_id = a;
        $.ajax({
            type: "POST",
            data: { rem_id: rem_id },
            url: "today.php",
            success: function (data) {
            window.location.reload();
        },
      });
    }
</script>
<?php echo"$part_footer";?>