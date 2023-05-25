<?php

include_once("../settings/config.php");

if (!isset($_COOKIE['user_login'])) {
  header('Location: ../login.php');
}

$id = $_GET['id'];

$result = mysqli_query($mysqli, "SELECT * FROM menus WHERE id='$id'");

while ($menu_data = mysqli_fetch_array($result)) {
  $name = $menu_data['name'];
  $image = $menu_data['image'];
  $description = $menu_data['description'];
  $type = $menu_data['type'];
  $price = $menu_data['price'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Menu | Dashboard Admin</title>

  <!-- style -->
  <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
  <div class="container" style="display: flex; justify-content: center; align-items: center;">
    <div class="half">
      <div class="anu">
        <h2 style="padding: 0 0 10px 20px;">
          <a href="menu.php" class="instead">Back</a>
        </h2>
        <div class="card">
          <img src="../assets/images/bg.png" style="opacity: 0.09;" class="card-bg">
          <div class="card-content center">
            <h1><?= $name ?></h1>
            <div class="image-detail">
              <img src="../assets/images/menus/<?= $image ?>" class="rilfud" alt="image product">
            </div>
            <h3><?= $description ?></h3>
            <div class="anu" style="display: flex;">
              <h2>
                <?php if ($type == 0) {
                  echo "Food";
                } else {
                  echo "Beverage";
                } ?>
                |
              </h2>
              <h2>&nbsp;<?= rupiah($price) ?></h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>