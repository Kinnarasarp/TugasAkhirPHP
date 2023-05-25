<?php

include_once("settings/config.php");
include 'layout/sidebar.php';
$user = mysqli_query($mysqli, "SELECT * FROM users");
$menu = mysqli_query($mysqli, "SELECT * FROM menus");

$total_user = mysqli_num_rows($user);
$total_menu = mysqli_num_rows($menu);

if (!isset($_COOKIE['user_login'])) {
  header('Location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=`device-width`, initial-scale=1.0">
  <title>Dashboard Admin</title>

  <!-- style -->
  <link rel="stylesheet" href="assets/style.css">
</head>

<body style="overflow: hidden;">
  <?= $sidebar ?>
  <div class="container" style="margin-left: 250px;">
    <div class="card">
      <div class="card-content">
        <h1>Welcome To Dashboard Cafe Cak Agit ! </h1>
        <p>Create or Edit Menu in Food & Beverages</p>
        <div class="bagidua">
          <div class="basabasi">
            <div class="card">
              <img src="assets/images/bg.png" class="card-bg">
              <h3>Registered Accounts : </h3>
              <h3><?= $total_user ?></h3>
            </div>
          </div>
          <div class="basabasi">
            <div class="card">
              <img src="assets/images/bg.png" class="card-bg">
              <h3>Number of Menus : </h3>
              <h3><?= $total_menu ?></h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>