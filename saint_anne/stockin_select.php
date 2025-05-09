<?php include("connect.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock In Records</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        h1 {
            color: #1877f2;
            margin-bottom: 30px;
        }
        .btn-primary, .btn-danger, .btn-success {
            padding: 6px 12px;
        }
        a {
            text-decoration: none;
        }
        .btn a {
            color: white;
        }
        .btn a:hover {
            color: #ffc107;
        }
        table {
            background-color: white;
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
    <h1 class="text-center">Stock In Records</h1>

    <div class="text-end mb-3">
        <a href="stock_in.php" class="btn btn-success">+ Add Stock In</a>
    </div>

    <table class="table table-bordered table-hover text-center">
        <thead class="table-dark">
            <tr>
                <th>Product ID</th>
                <th>Date In</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total Price</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM `stock_in`";
            $query = mysqli_query($conn, $sql);
            if ($query && mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    echo "<tr>
                        <td>{$row['Product_Id']}</td>
                        <td>{$row['Date']}</td>
                        <td>{$row['Quantity']}</td>
                        <td>{$row['Unit_Price']}</td>
                        <td>{$row['Total_Price']}</td>
                        <td><a href='stockin_update.php?id={$row['Product_Id']}' class='btn btn-primary btn-sm'>Update</a></td>
                        <td><a href='stockin_delete.php?id={$row['Product_Id']}' class='btn btn-danger btn-sm'>Delete</a></td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No stock-in records found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-outline-primary">← Back to Home</a>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
