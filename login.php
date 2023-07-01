<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Signup</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
		<?php
session_start(); // start session

    //connect to database
    $conn = mysqli_connect("localhost", "root", "", "db1");
    
    //check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    //sanitize user input
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    //query the database for the user
    $query = "SELECT * FROM details WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);
    $alert = '<div class="alert alert-danger alert-dismissible fade show mb-0">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>Account Does Not Exist</strong> These credentials do not match our records.
  </div><div class="alert alert-info alert-dismissible fade show mt-0">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  You will be redirected back in 5 seconds.</div>';
    //check if user exists
    if(mysqli_num_rows($result) == 1){
        header("Location: index.html");
    }else{
		echo $alert;
        echo "<script>
        setTimeout(function() {
            window.location.href = 'login.html';
        }, 5000);
        </script>";
    }
    
    mysqli_close($conn);
?>
</body>
</html>

