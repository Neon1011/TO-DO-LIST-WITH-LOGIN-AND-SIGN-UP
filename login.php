<?php
$login=false;
$showError=false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'cont/_dbconnect.php';
    $username=$_POST["username"];
    $password=$_POST["password"];
$sql= "SELECT * FROM users WHERE username='$username'";
$result=mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
if($num ==1)
{
  while($row=mysqli_fetch_assoc($result))
  {
    if(password_verify($password, $row['password']))
    {
      $login =true;
      session_start();
      $_SESSION['loggedin'] = true;
      $_SESSION['username'] = $username;
      header("location:index.php");
    }
    else
    {
      $showError = "Invalid credential";
    }
  }
}
else
{
  $showError = "Invalid credential";
}
}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>LOGIN</title>
  </head>
  <body>
      <?php
      require 'cont/_nav.php' ?>
       <?php
    if($login){
     echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
               <strong>Success!</strong> You are LOGGED IN.
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                
      </div>';
    }

   if($showError){
     echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
               <strong>Error!</strong> '.$showError.'
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                
     </div>';
  }
  ?>
    


      <div class="container my-4">
      <h1 class="text-center">Login TO OUR WEBSITE</h1>
      <form action="login.php" method="POST">
          <div class="mb-3 col-md-6 ">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
            
          <div class="mb-3 ">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
    
          </div>
          <button type="submit" class="btn btn-primary col-md-6">Login</button>
        </form>
      </div>
    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
  </body>
</html>