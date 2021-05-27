<?php
    include '../partional/db.php';
    $ShowAlert=false;
    $showError=FALSE;
    if ($_SERVER['REQUEST_METHOD']=="POST")
    {
        $username=$_POST['UserName'];
        $pass=$_POST['Password'];
        $cPass=$_POST['ConPassword'];
        // $exits=false;
        $exits="SELECT * FROM `user` WHERE `username`='$username'";
        $result=mysqli_query($conn,$exits);
        $numExitsRows=mysqli_num_rows($result);
        if($numExitsRows>0)
        {
            // $exit=true;
            $showError="USERNAME ALREADY EXITS 👎";
        }
        else{
            // $exit=false;
            if (($pass==$cPass)){
                $sql="INSERT INTO `user`(`username`, `password`, `date`) VALUES ('$username','$pass',current_timestamp())";
                $result=mysqli_query($conn,$sql);
                if ($result) {
                    # code...
                    $ShowAlert=true;
                }
            }
            else{
                $showError="PASSWORD NOT MATCH  👎";
            }
        }
    }
    else{
        header("location:login.php");
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

    <title>Sign Up</title>
</head>

<body>
    <?php
    require '../partional/_nav.php';
    if ($ShowAlert) {
        
        echo"
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong> Success ! </strong> Your Account is Created, Now You can Log In.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
    if ($showError) {
        
        echo"
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong> WRONG ! </strong>.$showError.'
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }

    ?>
    <div class="container my-4">
        <h1 class="text-center">Sign Up To Our Web Site </h1><br>
        <form action="index1.php" method="POST" style="display: flex; align-items: center; flex-direction: column;">
            <div class="mb-3 col-md-6">
                <label for="Username" class="form-label" style="text-align: center; display: block;">User Name : </label>
                <input type="text" class="form-control" placeholder="Enter User Name" name="UserName" id="UserName" aria-describedby="emailHelp">
                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            </div>
            <div class="mb-3 col-md-6">
                <label for="Password" class="form-label" style="text-align: center; display: block;">Password : </label>
                <input type="password" class="form-control" placeholder="Enter Password" id="Password" name="Password">
            </div>
            <div class="mb-3 col-md-6">
                <label for="ConPassword" class="form-label" style="text-align: center; display: block;">Confirm Password : </label>
                <input type="password" class="form-control " id="ConPassword" name="ConPassword" placeholder="Enter Confirm Password">
                <div id="emailHelp" class="form-text text-muted">Make Sure To Type The Same Password.</div>
            </div>
            <button type="submit" class="btn btn-primary">SignUp</button>
            <br>
            <button type="submit" class="btn btn-primary">Login In</button>
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