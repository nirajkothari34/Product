<?php
include '../partional/db.php';
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
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
                        <a class="nav-link active" aria-current="page" href="index1.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="logout.php">Log out</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container my-3">
        <form method="get">
             <br>
            <div class="row">
                <div class="col-mb-4">
                    <div class="input-group mb-2">
                        <?php
                        $quey = "Select * From product";
                        $q_run = mysqli_query($conn, $quey);
                        if (mysqli_num_rows($q_run) > 0) :
                            foreach ($q_run as $rows) :
                                $checked = [];
                                if (isset($_GET['brand'])) {
                                    $checked = $_GET['brand'];
                                }
                        ?>
                                <div class="col-md-3">
                                    <input type="checkbox" name="brand[]" id="" value="<?= $rows['cat_id'] ?>" <?php if (in_array($rows['cat_id'], $checked)) {
                                                                                                                    echo "Checked";
                                                                                                                } ?> />
                                    <?php echo $rows['categories'] ?>

                                </div>
                            <?php
                            endforeach;
                        else :
                            ?>
                            <div class="col-md-3">
                                <h3>No Brand Found</h3>
                            </div><?php
                                endif;
                                    ?>
                    </div>
                </div>
                <button class="btn btn-outline-primary" type="submit">Filter</button>
            </div>
        </form>
    </div>
    <table class="table table-sm caption-top table-responsive-md table-hover align-middle table-active table-bordered border-primary table-striped" id="myTable" border="5">
        <tr>
            <th scope="col">Sr No</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Description</th>
            <th scope="col">Categories</th>
            <th scope="col">Image</th>
        </tr>
        <?php
        if (isset($_GET['brand'])) {
            $checked = [];
            $checked = $_GET['brand'];
            foreach ($checked as $rowBrand) {
                
            }
            $sql = "Select * From product where cat_id IN ($rowBrand)";
            $p_run = mysqli_query($conn, $sql);
            if (mysqli_num_rows($p_run) > 0) {
                foreach ($p_run as $product) :
        ?>
                    <div class="col-md-4 mt-3">
                        <div class="border p-2">

                            <?php
                            $srno = 0;
                            $srno = $srno + 1;
                            echo "<tr>
            <th scope='row'>" . $srno . "</th>
            <td>" . $product['productName'] . "</td>
                <td>" . "₹" . $product['productPrice'] . "</td>
                <td>" . $product['ProductDescription'] . "</td>
                <td>" . $product['categories'] . "</td>
                <td>" ?><img src="<?php echo $product['image'] ?>" height="100" width="100"><?php echo "</td>
                
                </tr>"; ?>
                        </div>
                    </div>
        <?php
                endforeach;
            }
        }
        ?>
    </table>
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