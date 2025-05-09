<?php
include("connect.php");

$pr_id = $qua = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT `Product_Id_out`, `Quantity_out` FROM `stock_out` WHERE Product_Id_out='$id'";
    $query = mysqli_query($conn, $sql);

    if ($query && mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $pr_id = $row['Product_Id_out'];
        $qua = $row['Quantity_out'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Stock Out</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f2f5;
        }
        .form-container {
            max-width: 500px;
            margin: 80px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.1);
        }
        .form-title {
            text-align: center;
            margin-bottom: 20px;
            color: #1877f2;
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

<div class="form-container">
    <h2 class="form-title">✏️ Update Stock Out Record</h2>
    <form action="" method="POST">
        <div class="mb-3">
            <label class="form-label">Product ID</label>
            <input type="number" name="id" class="form-control" value="<?php echo htmlspecialchars($pr_id); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Quantity Out</label>
            <input type="number" name="quantity" class="form-control" value="<?php echo htmlspecialchars($qua); ?>" required>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
            <a href="stockout_select.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $p_id = $_POST['id'];
    $quantity = $_POST['quantity'];

    $sql = "UPDATE `stock_out` SET `Product_Id_out`='$p_id', `Quantity_out`='$quantity' WHERE Product_Id_out='$id'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        header("Location: stockout_select.php");
        exit();
    } else {
        echo "<div class='text-center text-danger mt-3'>❌ Update failed: " . mysqli_error($conn) . "</div>";
    }
}
?>

</body>
</html>
