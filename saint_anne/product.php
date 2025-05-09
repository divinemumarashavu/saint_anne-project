<?php
include("connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Insert</title>

    <!-- Bootstrap CSS (for responsive design and modern UI components) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJmZ3Q8kX58yE+VbLs6m9KfgM5bX2E+Lfkk8rlPbAAwGVQz4jjw8Vw6WBoIf" crossorigin="anonymous">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            width: 100%;
            max-width: 400px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: center;
        }
        .container h1 {
            font-size: 24px;
            color:rgb(166, 183, 204);
        }
        .container h2 {
            font-size: 20px;
            color: #333;
            margin-bottom: 30px;
        }
        .form-control {
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #1877f2;
            border-color: #1877f2;
            padding: 10px 0;
            width: 100%;
            border-radius: 5px;
        }
        .btn-primary:hover {
            background-color: #145dbf;
            border-color: #145dbf;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            width: 100%;
            margin-top: 10px;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
        .text-link {
            text-decoration: none;
            color: #1877f2;
        }
        .text-link:hover {
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
      color: #3c2e61;
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
    <h1>Welcome to Product Page</h1>
    <h2>Insert Product</h2>

    <form action="" method="POST">
        <div class="mb-3">
            <label for="productName" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="productName" name="name" placeholder="Insert Product" required>
        </div>

        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>

    <button class="btn btn-secondary">
        <a href="product_select.php" class="text-link">View Data</a>
    </button>
</div>

<?php
if (isset($_POST['submit'])) {
    $name = $_POST["name"];
    $insert = "INSERT INTO `products`(`Product_Name`) VALUES ('$name')";
    $query = mysqli_query($conn, $insert);

    if ($query) {
        // Redirect to the products view page
        header("Location: product_select.php");
        exit();
    } else {
        echo "<div class='alert alert-danger' role='alert'>Failed to insert product: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!-- Bootstrap JS (for modal, tooltips, etc.) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-wEpo0Gg9zLgZxGd6b9Os1zFqS1zA5p4e0DhG1GR8vhu6iFa1r9UWhuHXyWe0zSK2" crossorigin="anonymous"></script>

</body>
</html>
