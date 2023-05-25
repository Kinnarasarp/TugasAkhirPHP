<?php

include_once("settings/config.php");

$error = false;
$success = false;

session_start();

if (isset($_COOKIE['user_login'])) {
  header('Location: index.php');
}

if (isset($_SESSION['success'])) {
  $success = true;
}

if (isset($_POST['login_user'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  $query = mysqli_query($mysqli, "SELECT * FROM users WHERE username = '$username' and password = '$password'");
  $data = mysqli_fetch_object($query);
  if ($query->num_rows == 1) {
    setcookie('user_login', $data->id, time() + 3600 * 30, '/');
    header('Location: index.php');
  } else {
    $_SESSION['error'] = 'Invalid Email or Password !';
    header('Location: login.php');
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
  <title>Login Page</title>

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
            <h1 style="margin-top: 0;">Login</h1>
          </div>
          <div class="error-message">
            <?php
            if ($success == true) {
              echo '<h3 style="color: green;">' . $_SESSION["success"] . '</h3>';
              session_unset();
            }
            ?>
          </div>
          <div>
            <p>Dont have an account? <a href="register.php" class="instead">Sign up instead</a></p>
          </div>
          <form method="POST">
            <div class="form">
              <label for="name" class="label-form">Username</label>
              <input type="text" name="username" id="name" required placeholder="Enter Your Username Here">
            </div>
            <div class="form">
              <label for="password" class="label-form">Password</label>
              <input type="password" name="password" id="password" required placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
            </div>
            <div id="error-message">
              <?php
              if (isset($_SESSION['error'])) {
                echo '<h3 style="color: red; margin: 0 10px;">' . $_SESSION['error'] . '</h3>';
                // session_unset();
              }
              ?>
            </div>
            <div class="submit">
              <button class="button" type="submit" name="login_user">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>