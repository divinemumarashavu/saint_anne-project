<?php
include("connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory Report</title>
    <style>
        /* Your existing styles here */
    </style>
</head>

<link rel="stylesheet" href="report.css">


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

<header>
    <h1>Inventory Management Report</h1>
    <nav>
        <ul>
            <li><a href="#general">Date And Range Report</a></li>
            <li><a href="specific.php">General Report && Specific Product</a></li>
        </ul>
    </nav>
</header>

<main>
    <section id="periodic">
        <h2>Report by Date Range</h2>
        <form method="GET" action="#periodic">
            <label>From: <input type="date" name="start" required></label>
            <label>To: <input type="date" name="end" required></label>
            <button type="submit">Generate</button>
        </form>

        <?php if (isset($_GET['start']) && isset($_GET['end'])):
            $start = $_GET['start'];
            $end = $_GET['end'];
        ?>

        <h4>Stock In (<?= $start ?> to <?= $end ?>)</h4>
        <table>
            <thead>
                <tr><th>Product ID</th><th>Product Name</th><th>Date</th><th>Qty</th><th>Unit Price</th><th>Total Price</th></tr>
            </thead>
            <tbody>
            <?php
            $total = 0;
            $in_quantity = 0;
            $in = mysqli_query($conn, "SELECT * FROM stock_in INNER JOIN products ON stock_in.Product_Id = products.Product_Id WHERE Date BETWEEN '$start' AND '$end'");
            while ($row = mysqli_fetch_assoc($in)) {
                $total += $row['Total_Price'];
                $in_quantity += $row['Quantity'];
                
                echo "<tr>
                    <td>{$row['Product_Id']}</td>
                    <td>{$row['Product_Name']}</td>
                    <td>{$row['Date']}</td>
                    <td>{$row['Quantity']}</td>
                    <td>{$row['Unit_Price']}</td>
                    <td>{$row['Total_Price']}</td>
                </tr>";
            }
            ?>
            </tbody>
        </table><br>
        <p><strong>For That Date <?= $start ?> to <?= $end ?> <b>stock_in</b> Total Quantity:</strong><?php echo $in_quantity; ?> </p>
        <p><strong>For That Date <?= $start ?> to <?= $end ?> <b>stock_in</b> Total Price:</strong><?php echo $total; ?> </p>
<br><br><br><br>
        <h4>Stock Out (<?= $start ?> to <?= $end ?>)</h4>
        <table>
            <thead>
                <tr><th>Product ID</th><th>Product Name</th><th>Date</th><th>Qty</th></tr>
            </thead>
            <tbody>
            <?php
            $out_quantity = 0;
            $out = mysqli_query($conn, "SELECT * FROM stock_out INNER JOIN products ON stock_out.Product_Id_out = products.Product_Id WHERE Date_out BETWEEN '$start' AND '$end'");
            while ($row = mysqli_fetch_assoc($out)) {
                $out_quantity += $row['Quantity_out'];
                echo "<tr>
                    <td>{$row['Product_Id_out']}</td>
                    <td>{$row['Product_Name']}</td>
                    <td>{$row['Date_out']}</td>
                    <td>{$row['Quantity_out']}</td>
                </tr>";
            }
            ?>
            </tbody>
        </table>

        <p><strong>For That Date <?= $start ?> to <?= $end ?> <b>stock_out</b> Total Quantity:</strong><?php echo $out_quantity; ?> </p>
        <?php endif; ?>
    </section>
</main>

</body>
</html>
