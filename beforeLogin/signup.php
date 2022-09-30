<?php 
include("../config.php");
if(isset($_POST["name"])){
    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    // Password condition
    if(strlen($password)> 5 && strlen($username)>5){
        
        $query = "SELECT * FROM users WHERE username = '$username'";
        // Duplicate email check
        if(mysqli_num_rows(mysqli_query($con,$query))==1){
            echo "This username is used by another account.";
        }
        else{
            // Create User
            $query = "INSERT INTO users 
            (name,username,password) VALUES
            ('$name','$username','$password')";
            if(mysqli_query($con,$query)){
                echo "Signned up successfully. Please Login";
            }
        }
    }
    else{
        echo "Username and Password must be 6 charater's long";
    }
}
else{
    echo "404 Page not found";
}
?>