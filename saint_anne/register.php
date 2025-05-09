<?php
include("connect.php");

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $pass = $_POST['password'];

    $sql = "INSERT INTO `login`(`UserName`, `Password`) VALUES ('$name','$pass')";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        $message = "Account created successfully! You can now log in.";
    } else {
        $error = "Error: Unable to register. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register - Stock Management</title>
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

    .register-box {
      background-color: #fff;
      padding: 40px;
      width: 400px;
      border-radius: 10px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    .register-box h1 {
      font-size: 24px;
      color: #1877f2;
      text-align: center;
      margin-bottom: 25px;
    }

    .register-box label {
      font-weight: 600;
      display: block;
      margin-top: 15px;
      color: #333;
    }

    .register-box input[type="text"],
    .register-box input[type="password"] {
      width: 100%;
      padding: 12px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
    }

    .register-box button {
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

    .register-box button:hover {
      background-color: #145dbf;
    }

    .register-box p {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
    }

    .register-box a {
      color: #1877f2;
      text-decoration: none;
    }

    .register-box a:hover {
      text-decoration: underline;
    }

    .message {
      text-align: center;
      color: green;
      margin-top: 15px;
    }

    .error {
      text-align: center;
      color: red;
      margin-top: 15px;
    }

  </style>
</head>
<body>

<div class="container">
  <div class="register-box">
    <h1>Create Your Account</h1>
    <form method="POST" action="">
      <label for="name">Username</label>
      <input type="text" name="name" placeholder="Enter a username" required>

      <label for="password">Password</label>
      <input type="password" name="password" placeholder="Create a password" required>

      <button type="submit" name="submit">Register</button>

      <?php if (!empty($message)) echo "<div class='message'>$message</div>"; ?>
      <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

      <p>Already have an account? <a href="login.php">Login here</a></p>
    </form>
  </div>
</div>

</body>
</html>
