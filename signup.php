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
    //connect to database
    $conn = mysqli_connect("localhost", "root", "", "db1");
    //check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    //sanitize user input
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    try{
    //insert user into the database
    $query = "INSERT INTO details VALUES ('$name', '$email', '$password')";
    $alert = '<div class="alert alert-danger alert-dismissible fade show mb-0">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>Account Already Exists</strong> Please try again with different email.
  </div><div class="alert alert-info alert-dismissible fade show mt-0">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  You will be redirected back in 5 seconds.
</div>';
    if(!$result = mysqli_query($conn, $query)){
        throw new Exception(mysqli_error($conn));
    }
    }catch(Exception $e){
        echo $alert;
        echo "<script>
        setTimeout(function() {
            window.location.href = 'signup.html';
        }, 5000);
        </script>";
    }
    //close database connection
    mysqli_close($conn);
    if($result){
        echo "<script>
        window.location.href = 'login.html';
        </script>";
    }else  {
        echo "<script>
        alert('Invalid details');
        </script>";
    }
?>
    </body>
</html>
