<?php
session_start();
include("connect.php");

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $pass = $_POST['password'];

    $sql = "SELECT `UserName`, `Password` FROM `login` WHERE `UserName`='$name' and `Password`='$pass'";
    $query = mysqli_query($conn, $sql);
    $fetch = mysqli_fetch_array($query);

    if (is_array($fetch)) {
        $_SESSION['name'] = $fetch['UserName'];
        $_SESSION['pass'] = $fetch['Password'];
        header("location: index.php");
    } else {
        $error = "Please enter a valid username and password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - Stock Management</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f0f2f5;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-box {
      background-color: #fff;
      padding: 40px;
      width: 360px;
      border-radius: 10px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    .login-box h1 {
      font-size: 24px;
      color: #1877f2;
      text-align: center;
      margin-bottom: 25px;
    }

    .login-box label {
      font-weight: 600;
      display: block;
      margin-top: 15px;
      color: #333;
    }

    .login-box input[type="text"],
    .login-box input[type="password"] {
      width: 100%;
      padding: 12px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
    }

    .login-box button {
      width: 100%;
      padding: 12px;
      margin-top: 20px;
      background-color: #1877f2;
      color: white;
      font-weight: bold;
      font-size: 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .login-box button:hover {
      background-color: #145dbf;
    }

    .login-box p {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
    }

    .login-box a {
      color: #1877f2;
      text-decoration: none;
    }

    .login-box a:hover {
      text-decoration: underline;
    }

    .error {
      color: red;
      text-align: center;
      margin-top: 10px;
    }

  </style>
</head>
<body>

<div class="container">
  <div class="login-box">
    <h1>STOCK_MANAGEMENT</h1>
    <form method="POST" action="">
      <label for="username">Username</label>
      <input type="text" name="name" placeholder="Enter your username" required>

      <label for="password">Password</label>
      <input type="password" name="password" placeholder="Enter your password" required>

      <button type="submit" name="submit">Log In</button>

      <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

      <p>I don't have an account? <a href="register.php">Create one</a></p>
    </form>
  </div>
</div>

</body>
</html>
