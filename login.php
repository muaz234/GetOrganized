<?php
require_once 'database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Login</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="" method="post">

              <div class="form-group ">
                <label>Email:<sup>*</sup></label>
                <input type="text" name="email" class="form-control">
                <span class="help-block"></span>
            </div>
            <div class="form-group ">
                <label>Password:<sup>*</sup></label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary"  value="Submit" style="float:right;">
            </div>

        </form>

    </div>
     <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>
</html>


<?php

   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form
      $email = mysqli_real_escape_string($conn,$_POST['email']);
      $password = mysqli_real_escape_string($conn,$_POST['password']);

  if(empty($email) || empty($password) ) {

    $fill="Please fill in required details";
    echo "<script type='text/javascript'> alert('$fill'); </script>";
  										}
  else {
      $sql = "SELECT  empid,email,password,level,empname from  employee WHERE  email = '$email' and  password = '$password'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row

      if($count == 1) {
        if($row['level'] == "manager") {
          $_SESSION["empname"] = $row["empname"];
          $_SESSION["empid"] = $row["empid"];
          $_SESSION["level"] = $row["level"];
          header("Location:indexadmin.php" );
        } else if($row['level'] == "staff"){
          $_SESSION["empname"] = $row["empname"];
          $_SESSION["empid"] = $row["empid"];
          $_SESSION["level"] = $row["level"];
          header("Location:indexdua.php");
        }
      }
      else {
         $error = "Your Login Name or Password is invalid";
         echo "<script type='text/javascript'> alert('$error'); </script>";
          }
   }
 }
?>
