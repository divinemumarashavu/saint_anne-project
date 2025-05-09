<?php
include("connect.php");

$p_id = "";
$name = "";

if (isset($_GET['id'])) {
    $p_id = $_GET['id'];

    $select = "SELECT `Product_Id`, `Product_Name` FROM `products` WHERE Product_Id = '$p_id'";
    $query = mysqli_query($conn, $select);

    if ($query && mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $name = $row["Product_Name"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Product</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            margin-top: 60px;
            max-width: 500px;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #1877f2;
            margin-bottom: 30px;
        }
        .form-label {
            font-weight: bold;
        }
        .btn-primary {
            width: 100%;
            background-color: #1877f2;
            border: none;
        }
        .btn-primary:hover {
            background-color: #145dbf;
        }
        .btn-secondary {
            width: 100%;
            margin-top: 10px;
        }
        .text-center a {
            text-decoration: none;
            color: #1877f2;
        }
        .text-center a:hover {
            text-decoration: underline;
        }
    </style>

    
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  
  <style>
    body {
      background-color: #5c4d91;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .navbar-custom {
      background-color: #3c2e61;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }

    .navbar-nav .nav-link {
      color: #fff !important;
      font-weight: 500;
      margin: 0 10px;
      position: relative;
      transition: all 0.3s ease-in-out;
    }

    .navbar-nav .nav-link::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0%;
      height: 3px;
      background-color: #ffc107;
      transition: width 0.4s ease-in-out;
    }

    .navbar-nav .nav-link:hover::after,
    .navbar-nav .nav-link:focus::after {
      width: 100%;
    }

    .navbar-nav .nav-link:hover {
      color: #ffc107 !important;
      transform: scale(1.05);
    }

    .navbar-nav .nav-link:focus {
      outline: none;
      color: #ffc107 !important;
    }

    .navbar-toggler {
      border-color: #fff;
    }

    .navbar-toggler-icon {
      background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='white' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }
  </style>
</head>
<body>



<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container">
    <a class="navbar-brand text-white fw-bold" href="#">Inventory</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-center" id="navMenu">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="product.php">Products</a></li>
        <li class="nav-item"><a class="nav-link" href="stock_in.php">Stock IN</a></li>
        <li class="nav-item"><a class="nav-link" href="stockout.php">Stock OUT</a></li>
        <li class="nav-item"><a class="nav-link" href="report.php">Report</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php">LOGOUT</a></li>
      </ul>
    </div>
  </div>
</nav>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<div class="container">
    <h1>Update Product</h1>
    <form action="" method="POST">
        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Update</button>
        <a href="product_select.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $name = $_POST["name"];
    $update = "UPDATE `products` SET `Product_Name`='$name' WHERE Product_Id = '$p_id'";
    $query = mysqli_query($conn, $update);

    if ($query) {
        header("Location: product_select.php");
        exit();
    } else {
        echo "<div class='alert alert-danger text-center mt-3'>Update failed: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
