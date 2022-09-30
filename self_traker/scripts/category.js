$(document).ready(function () {
  // For Adding subject
  $("#add_category").click(function (e) {
    e.preventDefault();
    let cat_name = document.getElementById("cat_name").value;
    if (cat_name) {
      $.ajax({
        type: "POST",
        data: { cat_name: cat_name },
        url: "extra/addCategory.php",
        success: function (data) {
          document.getElementById("add_message").innerHTML = data;
          $(`#allCategories`).load(`extra/allCategories.php`);
          if (data == "Category added successfully") {
            document.getElementById("cat_name").value = "";
          }
        },
      });
    } else {
      document.getElementById("add_message").innerHTML =
        "Please enter a category name.";
    }
  });
});
