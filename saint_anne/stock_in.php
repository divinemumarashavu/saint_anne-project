<?php
include("connect.php");
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $quantity = $_POST["quantity"];
    $unit = $_POST['unit'];
    $total = $_POST['total'];

    $insert = "INSERT INTO `stock_in`(`Product_Id`, `Quantity`, `Unit_Price`, `Total_Price`) 
               VALUES ('$id','$quantity','$unit','$total')";
    $query = mysqli_query($conn, $insert);

    if ($query) {
        header("location: stockin_select.php");
        exit();
    } else {
        $error = "Failed to insert: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Insert Product - Stock Management</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f0f2f5;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 500px;
      margin: 50px auto;
      background-color: #fff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    h1, h2 {
      text-align: center;
      color: #1877f2;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    label {
      margin-top: 15px;
      font-weight: 600;
      color: #333;
    }

    input {
      padding: 10px;
      font-size: 15px;
      border: 1px solid #ccc;
      border-radius: 6px;
      transition: border 0.3s;
    }

    input:focus {
      border-color: #1877f2;
      outline: none;
    }

    button {
      margin-top: 25px;
      padding: 12px;
      background-color: #1877f2;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #145dbf;
    }

    .view-btn {
      background-color: #28a745;
      margin-top: 10px;
    }

    .view-btn a {
      color: white;
      text-decoration: none;
      font-weight: bold;
    }

    .error {
      color: red;
      text-align: center;
      margin-top: 10px;
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
  <h1>Welcome To Product Page</h1>
  <h2>Insert Product</h2>

  <form action="" method="POST">
    <label for="id">Product ID</label>
    <input type="number" name="id" placeholder="Product Code" required>

    <label for="quantity">Quantity</label>
    <input type="number" name="quantity" placeholder="Product quantity" oninput="calculate()" required>

    <label for="unit">Unit Price</label>
    <input type="number" name="unit" placeholder="Unit Price" oninput="calculate()" required>

    <label for="total">Total Price</label>
    <input type="number" name="total" placeholder="Total Price" readonly>

    <button type="submit" name="submit">Submit</button>
  </form>

  <button class="view-btn"><a href="stockin_select.php">View Data</a></button>

  <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
</div>

<script>
  function calculate() {
    const quantity = parseFloat(document.getElementsByName('quantity')[0].value) || 0;
    const unit = parseFloat(document.getElementsByName('unit')[0].value) || 0;
    const total = quantity * unit;
    document.getElementsByName('total')[0].value = total.toFixed(2);
  }
</script>

</body>
</html>
