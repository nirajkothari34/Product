<?php
include '../partional/db.php';

$insert = false;
$update = false;
$delete = false;
if (isset($_GET['delete'])) {
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `product` WHERE `id` = $sno";
  $result = mysqli_query($conn, $sql);
}

if (isset($_POST['submit'])) {
  if (isset($_POST['sroEdit'])) {
    // Update the Record
    $sro = $_POST["sroEdit"];
    $name = $_POST['NameEdit'];
    $price = $_POST['PriceEdit'];
    $description = $_POST['descriptionEdit'];
    $brandslist = $_POST['brandslistEdit'];
    $File = $_FILES['FileEdit'];
    // SQL QUERY 
    $sql = "UPDATE `product` SET `productName` = '$name' , `productPrice` = '$price','ProductDescription'='$description'
    ,`categories`='$brandslist','image'='$File' WHERE `id` = $sro";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $update = true;
    } else {
      echo "We Could Not Update The Note Successfully...";
    }
  } 
  else {
    $name = $_POST['Names'];
    $price = $_POST['Price'];
    $description = $_POST['description'];
    $brandslist = $_POST['brandslist'];
    $Files = $_FILES['File'];
    $filename=$Files['name'];
    $fileError=$Files['error'];
    $fileTemp=$Files['tmp_name'];
    $fileText=explode('.',$filename);
    $fileCheck=strtolower(end($fileText));
    $fileStore=array('jpg','png','jpeg');
    if (in_array($fileCheck,$fileStore)) {
      $desFile='../Images/'.$filename;
      move_uploaded_file($fileTemp,$desFile);
      $insert = "INSERT INTO `product`(`productName`, `productPrice`, `ProductDescription`, `categories`, `image`)
      VALUES('$name','$price','$description','$brandslist','$desFile')";
      $query = mysqli_query($conn, $insert);
      if ($query) {
        $insert = true;
        // echo "The Record Has Been Inserted Successfully.. 👍 ";
      } else {
        echo "The Record Was Not Inserted Successfully  of this Error -->" . mysqli_error($conn);
      }
    }

  }
}
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

  <!--Edit  Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="Index1.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="sroEdit" id="sroEdit">
            <div class="mb-3">
              <label for="Title" class="form-label">Name</label>
              <input type="text" class="form-control" id="NameEdit" name="NameEdit" aria-describedby="emailHelp" />
              <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            </div>
            <div class="mb-3">
              <label for="desc" class="form-label">Price</label>
              <textarea class="form-control" id="priceEdit" name="priceEdit" rows="3"></textarea>
              <!-- <input type="password" class="form-control" id="exampleInputPassword1"> -->
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div>
            <div class="mb-3">
              <label for="Categories" class="form-label">Categories</label>
              <div class="form-check mb-3">
                <?php
                $brand_query = "SELECT * FROM cat";
                $query_run = mysqli_query($conn, $brand_query);

                if (mysqli_num_rows($query_run) > 0) {
                  foreach ($query_run as $brand) {
                ?>
                    <input type="checkbox" name="brandslistEdit" id="brandslistEdit" value="<?= $brand['Name']; ?>" /> &nbsp;<?= $brand['Name']; ?>
                <?php
                  }
                } else {
                  echo "No Record Found";
                }
                ?>
              </div>
              <div class="mb-3">
                <label for="Product Imagae">
                  Product Image
                </label>
                <input class="form-control" type="file" id="FileEdit" name="FileEdit">
                <!-- <input class="form-control" type="file" id="formFile"> -->
              </div>
            </div>
            <div class="modal-footer d-block mr-auto">
              <button type="submit" class="btn btn-primary">Save changes</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
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
  <?php
  if ($insert) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
     <strong>Success</strong> Your Note Has Been Successfully Inserted .
     <button type='button' class='btn-close' data-bs-dismiss'alert' aria-label='Close'></button>
   </div>";
  }
  ?>
  <?php
  if ($update) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
     <strong>Success</strong> Your Note Has Been Successfully Updated .
     <button type='button' class='btn-close' data-bs-dismiss'alert' aria-label='Close'></button>
   </div>";
  }
  ?>
  <?php
        if ($delete) {
          echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
     <strong>Success</strong> Your Note Has Been Successfully Deleted .
     <button type='button' class='btn-close' data-bs-dismiss'alert' aria-label='Close'></button>
   </div>";
        }
        ?>
  <div class="container my-2">
    <h3>Add A Product List</h3>
    <form action="index1.php" method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="Name" class="form-label">Name</label>
        <input type="text" class="form-control" maxlength="20" id="Names" name="Names" placeholder="Enter Product Name">
      </div>
      <div class="mb-3">
        <label for="price" class="form-label ">Price</label>
        <input type="text" class="form-control " id="Price" maxlength="10" name="Price" placeholder="Enter Product Price "  >
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" maxlength="50" name="description" rows="3"></textarea>
      </div>
      <div class="mb-3">
        <label for="Categories" class="form-label">Categories</label>
        <div class="form-check mb-3">
          <?php
          $brand_query = "SELECT * FROM cat";
          $query_run = mysqli_query($conn, $brand_query);

          if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $brand) {
          ?>
              <input type="checkbox" name="brandslist" id="Cat" value="<?= $brand['Name']; ?>" /> &nbsp;<?= $brand['Name']; ?>
          <?php
            }
          } else {
            echo "No Record Found";
          }
          ?>
        </div>
        <div class="mb-3">
          <label for="Product Imagae">
            Product Image
          </label>
          <input class="form-control" type="file" id="File" name="File">
          <!-- <input class="form-control" type="file" id="formFile"> -->
        </div>
      </div>
      <button type="submit" name="submit" class="btn btn-primary">Add Product</button>
    </form>
  </div>
  <hr>
  <div class="container my-4">
    <table class="table " id="myTable" border="3" cellpadding="20px">
      <thead>
        <tr>
          <th scope="col">Sr No</th>
          <th scope="col">Name</th>
          <th scope="col">Price</th>
          <th scope="col">Description</th>
          <th scope="col">Categories</th>
          <th scope="col">Image</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $srno = 0;
       
          $sql = "SELECT * FROM `product`";
          $result = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_assoc($result)) {
            $srno = $srno + 1;
            echo "<tr>
              <th scope='row'>" . $srno . "</th>
              <td>" . $row['productName'] . "</td>
              <td>"."₹". $row['productPrice'] . "</td>
              <td>" . $row['ProductDescription'] . "</td>
              <td>" . $row['categories'] . "</td>
              <td>"?><img src="<?php echo $row['image']?>" height="100" width="100"><?php echo"</td>
              <td> <button id=" . $row['id'] . " class='edit btn btn-sm btn-primary'>Edit</button> 
              <button class='delete btn btn-sm btn-danger' id=d" . $row['id'] . ">Delete</button></td>
              </tr>";
          }
        
        ?>
      </tbody>
    </table>  

  </div>
  <hr>
  <footer  align="center">
        Copyright &copy; 2021 - All right to <strong> Niraj Kothari </strong><br>
        
      </footer>


  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit", );
        tr = e.target.parentNode.parentNode;
        name = tr.getElementsByTagName("td")[0].innerText;
        price = tr.getElementsByTagName("td")[1].innerText;
        description = tr.getElementsByTagName("td")[2].innerText;
        cat = tr.getElementsByTagName("td")[3].innerText;
        image = tr.getElementsByTagName("td")[4].innerText;
        // console.log(title, decription);
        NameEdit.value = name;
        priceEdit.value = price;
        descriptionEdit.value = description;
        brandslistEdit.value = cat;
        FileEdit.value = image;
        sroEdit.value = e.target.id;
        console.log(e.target.id);
        $('#editModal').modal('toggle');
      })
    })
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("Delete", );
  
        sno = e.target.id.substr(1, );
        if (confirm("Are you Sure You Want To Delete This Note")) {
          console.log("yes");
          window.location = `index1.php?delete=${sno}`;
  
          //  Create a Form and Use Post Request to Submit a Form
  
        } else {
          console.log("No");
        }
      })
    })
  </script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->

</body>
</html>