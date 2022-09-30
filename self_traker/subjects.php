<?php
include("checkUser.php");
$_SESSION["active_number"] = 3;
$user_id = $_SESSION["user_id"];

if(isset($_POST["del_id"])){
  $d_id = $_POST["del_id"];
  $query1 = "DELETE FROM subjects WHERE id='$d_id' AND user_id='$user_id'";
  $result1 = mysqli_query($con,$query1);

  $query2 = "DELETE FROM sub_cat WHERE sub_id='$d_id' AND user_id='$user_id'";
  $result2 = mysqli_query($con,$query2);

  $query3 = "DELETE FROM data WHERE sub_id='$d_id' AND user_id='$user_id'";
  $result3 = mysqli_query($con,$query3);

  if($result1&&$result2&&$result3){
    echo "<script>alert('Subject Removed.');</script>";
  }

}
// For Updating Subject
if(isset($_POST["u_sub_name"])){
    $u_sub_name = $_POST["u_sub_name"];
    $o_sub_name = $_POST["o_sub_name"];
    $u_id = $_POST["u_id"];
    $u_status = $_POST["u_status"];

    if($u_sub_name == $o_sub_name){
        $query = "UPDATE subjects SET active='$u_status' WHERE id = '$u_id'";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<script>alert('Status updated successfully.');</script>";
        }
    }
    else{
        $query1 = "SELECT * FROM subjects WHERE user_id='$user_id' AND sub_name='$u_sub_name'";
        $result1 = mysqli_query($con,$query1);
        if(mysqli_num_rows($result1)==1){
            echo "<script>alert('Subject already exists.');</script>";
        }
        else{
            $query2 = "UPDATE subjects SET active='$u_status',sub_name='$u_sub_name' WHERE id = '$u_id'";
            $result2 = mysqli_query($con,$query2);
            if($result2){
                echo "<script>alert('Updated Successfully.');</script>";
            }
        }
    }
}
?>
<?php echo"$part_top";?>
<link rel="stylesheet" href="styles/subjects.css">
<?php echo"$part_nav";?>
<div class="container-fluid mt-4 mb-4">
    <div class="row">
        <div class="col-md-3 "></div>
        <div class="col-md-6 ">
            <div class="add_box">
                <input type="text" id="sub_name" class="add_input" placeholder="Enter Subject Name Here.."/>
                <button id="add_subject">Add</button>
            </div>
        </div>
        <div class="col-md-3 d-flex justify-content-center align-items-center">
            <p id="add_message"></p>
        </div>
    </div>
    <div class="row mt-4 mb-4" id="allSubjects">
        
    </div>
</div>

<!-- Modal For Updating -->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" autocomplete="off" >
            <input type="text" id="id_field" name="u_id" style="display: none;"/>
            <input type="text" id="o_sub_field" name="o_sub_name" style="display: none;"/>
            <label class="form-label mt-2"><b>Subject Name</b></label>
            <input type="text" id="sub_field" class="form-control mb-3" name="u_sub_name" required/>
            <label class="form-label mt-2"><b>Subject Status</b></label>
            <select id="status_field" class="form-control mb-3" name="u_status">
                <option value="1">Active</option>
                <option value="2">Deactivate</option>
            </select>
            <button class="btn btn-primary mt-3 mb-3" style="width: 100%;">Update</button>
        </form>
      </div>
      <div class="modal-footer">
        <small style="color:red">Removing Subject will remove all data of this subject.</small>
        <form method="POST">
          <input type="text" id="d_id_field" name="del_id" style="display: none;"/>
          <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal For Add category to subject -->
<div class="modal fade" id="showSub" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span id="subject_name"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h6>Added Categories</h6>
        <div class="all_data mb-4" id="addedCats"></div>
        <hr/>
        <h6>Left Categories</h6>
        <div class="all_data mb-4" id="leftCats"></div>
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function () {
        $(`#allSubjects`).load(`extra/allSubjects.php`);
    });
</script>
<script>
    var sub_name = "";
    var subj_id = "";
    function update(a,b,c){
      document.getElementById("id_field").value = a;
      document.getElementById("d_id_field").value = a;
      document.getElementById("sub_field").value = b;
      document.getElementById("o_sub_field").value = b;
      document.getElementById("status_field").value = c;
   }
   function removeCat(a){
    let cat_id = a;
    let sub_id = subj_id;
    $.ajax({
        type: "POST",
        data: { cat_id: cat_id,sub_id:sub_id },
        url: "extra/removeCat.php",
        success: function (data) {
          each_sub(sub_id,sub_name);
        },
      });
   }
   function addCat(a){
    let cat_id = a;
    let sub_id = subj_id;
    $.ajax({
        type: "POST",
        data: { cat_id: cat_id,sub_id:sub_id },
        url: "extra/addCat.php",
        success: function (data) {
          each_sub(sub_id,sub_name);
        },
      });
   }
   function each_sub(a,b){
    document.getElementById("subject_name").innerHTML = b;
    let sub_id = a;
    subj_id = a;
    sub_name = b;
    $.ajax({
        type: "POST",
        data: { sub_id: sub_id },
        url: "extra/addedCats.php",
        success: function (data) {
          document.getElementById("addedCats").innerHTML = data;
        },
      });

    $.ajax({
        type: "POST",
        data: { sub_id: sub_id },
        url: "extra/leftCats.php",
        success: function (data) {
          document.getElementById("leftCats").innerHTML = data;
        },
      });
}
</script>
<script src="scripts/subjects.js"></script>
<?php echo"$part_footer";?>