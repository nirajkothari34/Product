<?php
include '../partional/db.php';
if (isset($_POST['submit'])) {
    $user = $_POST['UserName'];
    $pass = $_POST['Password'];
    if ($user == 'admin' && $pass == "admin") {
        header("location:index1.php");
    } else {
        echo "Enter User Name And Password Not mtach ....";
        $username = $_POST['UserName'];
        $pass = $_POST['Password'];
        $sql = "SELECT * FROM `user` WHERE `username`='$username' AND `password`='$pass'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        header("Location: ../user/index1.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />

    <title>product</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Product</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Log out</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                    <button class="btn btn-outline-success" type="submit">
                        Search
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container my-4">
        <h1 class="text-center">Log In </h1>
        <br />
        <form action="#" method="POST" style="display: flex; align-items: center; flex-direction: column">
            <div class="mb-3 col-md-6">
                <label for="Username" class="form-label" style="text-align: center; display: block">User Name :
                </label>
                <input type="text" maxlength="30" class="form-control" required placeholder="Enter User Name" name="UserName" id="UserName" aria-describedby="emailHelp" />
                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            </div>
            <div class="mb-3 col-md-6">
                <label for="Password" class="form-label" style="text-align: center; display: block">Password :
                </label>
                <input type="password" maxlength="8" class="form-control" required placeholder="Enter Password" id="Password" name="Password" />
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Log In</button> <br>
            
            <div id="emailHelp" class="form-text text-muted">If You Are Already Regsitor Pls Like On Log in Button .</div> <br>
            <a href="../user/SignUp.php" type="button" class="btn btn-primary">User Registration</a>
            <div id="emailHelp" class="form-text text-muted">If You Are Not Regsitor Pls Like On Registration in Button .</div>
        </form>
    </div>
    <hr>
    <footer align="center">
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