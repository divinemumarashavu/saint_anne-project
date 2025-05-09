<?php
include("connect.php");

$id = $_GET['id'] ?? null;
$quantity = $unit = $total = "";

if ($id) {
    $sql = "SELECT `Product_Id`, `Quantity`, `Unit_Price`, `Total_Price` FROM `stock_in` WHERE Product_Id='$id'";
    $query = mysqli_query($conn, $sql);
    if ($query && $row = mysqli_fetch_assoc($query)) {
        $id = $row['Product_Id'];
        $quantity = $row['Quantity'];
        $unit = $row['Unit_Price'];
        $total = $row['Total_Price'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $p_id = $_POST['id'];
    $quantity = $_POST["quantity"];
    $unit = $_POST['unit'];
    $total = $_POST['total'];

    $update = "UPDATE `stock_in` SET `Quantity`='$quantity', `Unit_Price`='$unit', `Total_Price`='$total' WHERE Product_Id='$p_id'";
    $query = mysqli_query($conn, $update);

    if ($query) {
        header("Location: stockin_select.php");
        exit();
    } else {
        echo "<div class='alert alert-danger text-center'>Update failed: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Stock In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f2f5;
        }
        .form-container {
            max-width: 500px;
            margin: 60px auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h2 {
            color: #1877f2;
        }
        .btn-primary {
            width: 100%;
        }
        label {
            font-weight: 500;
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

<div class="container form-container">
    <h2 class="text-center mb-4">Update Stock Entry</h2>

    <form method="POST">
        <div class="mb-3">
            <label for="id" class="form-label">Product ID</label>
            <input type="number" class="form-control" name="id" value="<?= htmlspecialchars($id) ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" name="quantity" oninput="calculateTotal()" value="<?= htmlspecialchars($quantity) ?>" required>
        </div>

        <div class="mb-3">
            <label for="unit" class="form-label">Unit Price</label>
            <input type="number" class="form-control" name="unit" oninput="calculateTotal()" value="<?= htmlspecialchars($unit) ?>" required>
        </div>

        <div class="mb-3">
            <label for="total" class="form-label">Total Price</label>
            <input type="number" class="form-control" name="total" value="<?= htmlspecialchars($total) ?>" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>

        <div class="text-center mt-3">
            <a href="stockin_select.php" class="btn btn-outline-secondary btn-sm">Back to Stock In List</a>
        </div>
    </form>
</div>

<script>
    function calculateTotal() {
        const quantity = parseFloat(document.getElementsByName('quantity')[0].value) || 0;
        const unit = parseFloat(document.getElementsByName('unit')[0].value) || 0;
        const total = quantity * unit;
        document.getElementsByName('total')[0].value = total.toFixed(2);
    }
</script>

</body>
</html>
