<?php

if (!isset($_COOKIE['user_login'])) {
  header('Location: ../login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Menu | Dashboard Admin</title>

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

        <div class="card" style="display: flex; justify-content: center; align-items: center;">
          <div class="card-content">
            <div class="title">
              <h1 style="margin-top: 0;">Create Menu</h1>
            </div>
            <form action="add.php" method="post" name="add_menu" enctype="multipart/form-data">
              <div class="form">
                <label for="image" class="label-form">Product Image</label>
                <input type="file" name="image" id="image" required>
              </div>
              <div class="form">
                <label for="name" class="label-form">Name</label>
                <input type="text" name="name" id="name" required placeholder="Enter Name Here">
              </div>
              <div class="form">
                <label for="description" class="label-form">Description</label>
                <input type="text" name="description" id="description" required placeholder="Enter Description Here">
              </div>
              <div class="form">
                <label for="price" class="label-form">Price</label>
                <input type="text" name="price" id="price" required placeholder="Enter Price Here">
              </div>
              <div class="form">
                <label class="label-form">Type</label>
                <div class="radio">
                  <input type="radio" id="food" name="type" value="0">
                  <label for="food" style="padding-left: 10px;">Food</label>
                </div>
                <div class="radio">
                  <input type="radio" id="beverages" name="type" value="1">
                  <label for="beverages" style="padding-left: 10px;">Beverages</label>
                </div>
              </div>
              <div class="submit">
                <button type="submit" class="button" name="submit">Create</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php

  if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $type = $_POST['type'];

    $allowed = array('png', 'jpg', 'jpeg');
    $filename = $_FILES['image']['name'];
    $extension = explode('.', $filename);
    $sembarang = end($extension);

    if (in_array($sembarang, $allowed)) {
      $dummyname = $_FILES['image']['tmp_name'];

      $directory = "../assets/images/menus/";

      $changedirectory = move_uploaded_file($dummyname, $directory . $filename);

      include_once("../settings/config.php");

      $result = mysqli_query($mysqli, "INSERT INTO menus(image,name,description,price,type) VALUES('$filename','$name','$description','$price','$type')");

      header("Location: menu.php");
    }

    echo "<script>alert('Failed to Upload!')</script>";
  }

  ?>
</body>

</html>