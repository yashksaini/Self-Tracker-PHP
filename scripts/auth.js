$(document).ready(function () {
  // For Signup Form
  $("#signup_btn").click(function (e) {
    e.preventDefault();
    let name = document.getElementById("signup_name").value;
    let username = document.getElementById("signup_username").value;
    let password = document.getElementById("signup_password").value;
    if (name && username && password) {
      $.ajax({
        type: "POST",
        data: { name: name, username: username, password: password },
        url: "beforeLogin/signup.php",
        success: function (data) {
          document.getElementById("signup_message").innerHTML = data;
        },
      });
    } else {
      document.getElementById("signup_message").innerHTML =
        "Please fill all fields.";
    }
  });

  // For Login Form
  $("#login_btn").click(function (e) {
    e.preventDefault();
    let username = document.getElementById("login_username").value;
    let password = document.getElementById("login_password").value;
    if (username && password) {
      $.ajax({
        type: "POST",
        data: { username: username, password: password },
        url: "beforeLogin/login.php",
        success: function (data) {
          document.getElementById("login_message").innerHTML = data;
          if (data == "Login") {
            window.location.href = "self_traker/";
          }
        },
      });
    } else {
      document.getElementById("login_message").innerHTML =
        "Please fill all fields.";
    }
  });
});
