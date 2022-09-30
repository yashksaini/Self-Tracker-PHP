<?php
include("checkUser.php");
$_SESSION["active_number"] = 2;
$user_id = $_SESSION["user_id"];

if(isset($_POST["del_id"])){
  $d_id = $_POST["del_id"];
  $query1 = "DELETE FROM category WHERE id='$d_id' AND user_id='$user_id'";
  $result1 = mysqli_query($con,$query1);

  $query2 = "DELETE FROM sub_cat WHERE cat_id='$d_id' AND user_id='$user_id'";
  $result2 = mysqli_query($con,$query2);

  if($result1&&$result2){
    echo "<script>alert('Category Removed.');</script>";
  }

}
// Updating Category
if(isset($_POST["u_cat_name"])){
    $u_cat_name = $_POST["u_cat_name"];
    $u_id = $_POST["u_id"];

    $query1 = "SELECT * FROM category WHERE user_id='$user_id' AND cat_name='$u_cat_name'";
    $result1 = mysqli_query($con,$query1);
    if(mysqli_num_rows($result1)==1){
         echo "<script>alert('Category already exists.');</script>";
    }
    else{
        $query2 = "UPDATE category SET cat_name='$u_cat_name' WHERE id = '$u_id'";
        $result2 = mysqli_query($con,$query2);
        if($result2){
            echo "<script>alert('Updated Successfully.');</script>";
        }
    }
}
?>
<?php echo"$part_top";?>
<link rel="stylesheet" href="styles/subjects.css">
<?php echo"$part_nav";?>
<div class="container-fluid mt-4 mb-4">
    <div class="row">
        <div class="col-md-3 mt-2"></div>
        <div class="col-md-6 mt-2">
            <div class="add_box">
                <input type="text" id="cat_name" class="add_input" placeholder="Enter Category Name Here.."/>
                <button id="add_category">Add</button>
            </div>
        </div>
        <div class="col-md-3 mt-2 d-flex justify-content-center align-items-center">
            <p id="add_message"></p>
        </div>
    </div>
    <div class="row mt-4 mb-4" id="allCategories">
        
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
            <label class="form-label mt-2"><b>Category Name</b></label>
            <input type="text" id="cat_field" class="form-control mb-3" name="u_cat_name" required/>
            <button class="btn btn-primary mt-3 mb-3" style="width: 100%;">Update</button>
        </form>
      </div>
      <div class="modal-footer">
      <small style="color:red">Removing category will remove all data of this category.</small>
        <form method="POST">
          <input type="text" id="d_id_field" name="del_id" style="display: none;"/>
          <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal For Add Subject to Category -->
<div class="modal fade" id="showCat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span id="category_name"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h6>Added Subjects</h6>
        <div class="all_data mb-4" id="addedSubs"></div>
        <hr/>
        <h6>Left Subjects</h6>
        <div class="all_data mb-4" id="leftSubs"></div>
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function () {
        $(`#allCategories`).load(`extra/allCategories.php`);
    });
</script>
<script>
    var cat_name = "";
    var cate_id = "";
    function update(a,b){
      document.getElementById("id_field").value = a;
      document.getElementById("d_id_field").value = a;
      document.getElementById("cat_field").value = b;
   }
   function removeSub(a){
    let sub_id = a;
    let cat_id = cate_id;
    $.ajax({
        type: "POST",
        data: { cat_id: cat_id,sub_id:sub_id },
        url: "extra/removeSub.php",
        success: function (data) {
          each_sub(cat_id,cat_name);
        },
      });
   }
   function addSub(a){
    let sub_id = a;
    let cat_id = cate_id;
    $.ajax({
        type: "POST",
        data: { cat_id: cat_id,sub_id:sub_id },
        url: "extra/addSub.php",
        success: function (data) {
          each_sub(cat_id,cat_name);
        },
      });
   }
   function each_sub(a,b){
    document.getElementById("category_name").innerHTML = b;
    let cat_id = a;
    cate_id = a;
    cat_name = b;
    $.ajax({
        type: "POST",
        data: { cat_id: cat_id },
        url: "extra/addedSubs.php",
        success: function (data) {
          document.getElementById("addedSubs").innerHTML = data;
        },
      });

    $.ajax({
        type: "POST",
        data: { cat_id: cat_id },
        url: "extra/leftSubs.php",
        success: function (data) {
          document.getElementById("leftSubs").innerHTML = data;
        },
      });
}
</script>
<script src="scripts/category.js"></script>
<?php echo"$part_footer";?>