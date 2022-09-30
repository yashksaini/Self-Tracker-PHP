<?php 
session_start();
include("../config.php");
if(isset($_POST["username"])){
    
    $_SESSION['username']=$_POST['username'];
    $_SESSION['password'] = $_POST['password'];
    $username = $_SESSION["username"];
    $password = $_SESSION["password"];
    // Password condition
    if(strlen($password)< 6){
        echo "Password must be 6 charater's long";
    }
    else{
        $query = "SELECT * FROM users WHERE username = '$username' AND password='$password'";
        $result = mysqli_query($con,$query);
        if(mysqli_num_rows($result)==1){
            $row = $result->fetch_assoc();
            $_SESSION["current_name"] = $row["name"];
            $_SESSION["user_id"] = $row["id"];
            echo "Login";
        }
        else{
           echo "Username or password is incorrect";
        }
    }
}
else{
    echo "404 Page not found";
}
?>