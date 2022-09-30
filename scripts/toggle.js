const signup = document.getElementById("signup");
const login = document.getElementById("login");

const signup_tab = document.getElementById("signup_tab");
const login_tab = document.getElementById("login_tab");

const toggle = (value) => {
  if (value) {
    signup.className = "form";
    login.className = "nodisplay";
    signup_tab.className = "active_tab";
    login_tab.className = "";
  } else {
    signup.className = "nodisplay";
    login.className = "form";
    signup_tab.className = "";
    login_tab.className = "active_tab";
  }
};
