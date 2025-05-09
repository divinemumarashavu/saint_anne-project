<?php
include("connect.php")

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        header {
            background-color: #004080;
            color: white;
            padding: 20px;
            text-align: center;
        }
        nav ul {
            list-style: none;
            padding-left: 0;
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }
        h2 {
            color: #004080;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            margin-bottom: 40px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #e0e0e0;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="date"], input[type="number"], button {
            padding: 8px;
            margin: 5px;
            font-size: 1rem;
        }
        main {
            padding: 20px;
            background: #fff;
            border-radius: 5px;
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

<header>
    <h1>Inventory Management Report</h1>
    <nav>
        <ul>
            <li><a href="#general">General Report</a></li>
            <li><a href="#specific">Specific Product</a></li>
            <li><a href="#periodic">Date-based Report</a></li>
        </ul>
    </nav>
</header>

<main>
    <!-- General Report -->
    <section id="general">
        <h2>General Report</h2>
        <table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Total In</th>
                    <th>Total Out</th>
                    <th>Available</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "
                    SELECT p.Product_Id, p.Product_Name,
                        COALESCE(SUM(si.Quantity), 0) AS TotalIn,
                        COALESCE(SUM(so.Quantity_out), 0) AS TotalOut
                    FROM products p
                    LEFT JOIN stock_in si ON p.Product_Id = si.Product_Id
                    LEFT JOIN stock_out so ON p.Product_Id = so.Product_Id_out
                    GROUP BY p.Product_Id
                ";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $available = $row['TotalIn'] - $row['TotalOut'];
                    echo "<tr>
                        <td>{$row['Product_Id']}</td>
                        <td>{$row['Product_Name']}</td>
                        <td>{$row['TotalIn']}</td>
                        <td>{$row['TotalOut']}</td>
                        <td>$available</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <!-- Specific Product Report -->
    <section id="specific">
        <h2>Specific Product Report</h2>
        <form method="GET" action="#specific">
            <label>Product ID: <input type="number" name="id" required></label>
            <button type="submit">Search</button>
        </form>

        <?php if (isset($_GET['id'])): 
            $id = intval($_GET['id']);
            $prod = mysqli_query($conn, "SELECT * FROM products WHERE Product_Id = $id");
            if ($product = mysqli_fetch_assoc($prod)):
        ?>
        <h3><?= $product['Product_Name'] ?> (ID: <?= $product['Product_Id'] ?>)</h3>

        <h4>Stock In</h4>
        <table>
            <thead><tr><th>Date</th><th>Qty</th><th>Unit Price</th><th>Total</th></tr></thead>
            <tbody>
            <?php
            $in = mysqli_query($conn, "SELECT * FROM stock_in WHERE Product_Id = $id");
            while ($row = mysqli_fetch_assoc($in)) {
                echo "<tr>
                    <td>{$row['Date']}</td>
                    <td>{$row['Quantity']}</td>
                    <td>{$row['Unit_Price']}</td>
                    <td>{$row['Total_Price']}</td>
                </tr>";
            }
            ?>
            </tbody>
        </table>

        <h4>Stock Out</h4>
        <table>
            <thead><tr><th>Date</th><th>Qty</th></tr></thead>
            <tbody>
            <?php
            $out = mysqli_query($conn, "SELECT * FROM stock_out WHERE Product_Id_out = $id");
            while ($row = mysqli_fetch_assoc($out)) {
                echo "<tr>
                    <td>{$row['Date_out']}</td>
                    <td>{$row['Quantity_out']}</td>
                </tr>";
            }
            ?>
            </tbody>
        </table>
        <?php else: ?>
            <p>No product found with ID <?= $id ?>.</p>
        <?php endif; endif; ?>
    </section>

    
</main>

</body>
</html>
