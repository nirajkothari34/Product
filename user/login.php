<?php
    include '../partional/db.php';
    $login=false;
    $LoginError=FALSE;
    if ($_SERVER['REQUEST_METHOD']=="POST")
    {
        $username=$_POST['UserName'];
        $pass=$_POST['Password'];
            $sql="SELECT * FROM `user` WHERE `username`='$username' AND `password`='$pass'";
            $result=mysqli_query($conn,$sql);
            $num=mysqli_num_rows($result);
            if ($num==1) {
                $login=true;
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['username']=$username;
                header("Location: /user/index1.php");
            }
        else{
            $LoginError="Invalid Credentials 👎";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    
  </head>
  <body>
  <?php
    require '../partional/_nav.php';
    if ($login) {
        
        echo"
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong> Success ! </strong> You Are Logged In .
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
    if ($LoginError) {
        
        echo"
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong> WRONG ! </strong> Password And Confirm Password Not Match 👎'.$LoginError.'
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }

    ?>
 
 <div class="container my-4">
        <h1 class="text-center">Log In </h1><br>
        <form action="index1.php" method="POST" style="display: flex; align-items: center; flex-direction: column;">
            <div class="mb-3 col-md-6">
                <label for="Username" class="form-label" style="text-align: center; display: block;">User Name : </label>
                <input type="text" class="form-control" maxlength="30" placeholder="Enter User Name" name="UserName" id="UserName" aria-describedby="emailHelp">
                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            </div>
            <div class="mb-3 col-md-6">
                <label for="Password" class="form-label" style="text-align: center; display: block;">Password : </label>
                <input type="password" class="form-control" maxlength="8" placeholder="Enter Password" id="Password" name="Password" >
            </div>
            <button type="submit" class="btn btn-primary">Log In</button>
        </form>
    </div>
    <hr>
    <footer  align="center">
        Copyright &copy; 2021 - All right to <strong> Niraj Kothari </strong><br>
        
      </footer>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>