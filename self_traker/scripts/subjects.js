$(document).ready(function () {
  // For Adding subject
  $("#add_subject").click(function (e) {
    e.preventDefault();
    let sub_name = document.getElementById("sub_name").value;
    if (sub_name) {
      $.ajax({
        type: "POST",
        data: { sub_name: sub_name },
        url: "extra/addSubject.php",
        success: function (data) {
          document.getElementById("add_message").innerHTML = data;
          $(`#allSubjects`).load(`extra/allSubjects.php`);
          if (data == "Subject added successfully") {
            document.getElementById("sub_name").value = "";
          }
        },
      });
    } else {
      document.getElementById("add_message").innerHTML =
        "Please enter a subject name.";
    }
  });
});
