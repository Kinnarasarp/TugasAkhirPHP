<?php

include_once("settings/config.php");

if (isset($_COOKIE['user_login'])) {
  header('Location: index.php');
}



session_start();

if (isset($_POST['register'])) {
  $name = $_POST['name'];
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  $passwordconfirm = md5($_POST['passwordconfirm']);

  if (isset($name) && isset($username) && isset($password) && isset($passwordconfirm)) {
    if ($password == $passwordconfirm) {
      $result = mysqli_query($mysqli, "INSERT INTO users(name,username,password) VALUES('$name','$username','$password')");
      $_SESSION['success'] = "Account Registered !";
      header('Location: login.php');
    } else {
      $_SESSION["error"] = "Password doesn't match!";
      header("Location: register.php");
    }
  } else {
    $_SESSION["error"] = "Account creation failed!";
    header("Location: register.php");
  }
} else {
  session_destroy();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Page</title>

  <!-- style -->
  <link rel="stylesheet" href="assets/style.css">
</head>

<body>
  <div class="container" style="display: flex; justify-content: center; align-items: center; height: 100%;">
    <div class="half">
      <div class="card">
        <img src="assets/images/bg.png" class="card-bg">
        <div class="card-content">
          <div class="title">
            <h1 style="margin-top: 0;">Create Account</h1>
          </div>
          <div>
            <p>Already have an account? <a href="login.php" class="instead">Sign in instead</a></p>
          </div>
          <form method="POST">
            <div class="form">
              <label class="label-form" for="name">Name</label>
              <input type="text" name="name" id="name" placeholder="Enter New Name">
            </div>
            <div class="form">
              <label class="label-form" for="username">Username</label>
              <input type="text" name="username" id="username" placeholder="Enter New Username">
            </div>
            <div class="form">
              <label class="label-form" for="password">Password</label>
              <input type="password" name="password" id="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
            </div>
            <div class="form">
              <label class="label-form" for="password">Confirm Password</label>
              <input type="password" name="passwordconfirm" id="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
            </div>
            <div id="error-message">
              <?php
              if (isset($_SESSION["error"])) {
                echo "<h3 style='color: red; margin: 0 10px;'>" . $_SESSION["error"] . "</h3>";
              }
              ?>

            </div>
            <div class="submit">
              <button class="button" type="submit" role="button" name="register">Create</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>