<?php

include_once("../settings/config.php");

if (!isset($_COOKIE['user_login'])) {
  header('Location: ../login.php');
}

if (isset($_POST['update'])) {
  $id = $_POST['id'];

  $name = $_POST['name'];
  $description = $_POST['description'];
  $type = $_POST['type'];
  $price = $_POST['price'];

  $allowed = array('png', 'jpg', 'jpeg');
  $filename = $_FILES['image']['name'];

  $extension = explode('.', $filename);

  $sembarang = end($extension);

  if (in_array($sembarang, $allowed)) {
    $dummyname = $_FILES['image']['tmp_name'];

    $directory = "../assets/images/menus/";

    $changedirectory = move_uploaded_file($dummyname, $directory . $filename);

    include_once("../settings/config.php");

    $result = mysqli_query($mysqli, "UPDATE menus SET image='$filename', name='$name',description='$description', type='$type', price='$price' WHERE id=$id");

    header("Location: menu.php");
  }

  $result = mysqli_query($mysqli, "UPDATE menus SET name='$name',description='$description', type='$type', price='$price' WHERE id=$id");

  header("Location: menu.php");
}
?>
<?php

$id = $_GET['id'];

$result = mysqli_query($mysqli, "SELECT * FROM menus WHERE id='$id'");

while ($menu_data = mysqli_fetch_array($result)) {
  $name = $menu_data['name'];
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
  <title>Edit Menu | Dashboard Admin</title>

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
              <h1 style="margin-top: 0;">Edit Menu</h1>
            </div>
            <form action="edit.php" method="post" name="edit_user" enctype="multipart/form-data">
              <div class="form">
                <label for="image" class="label-form">Product Image</label>
                <input type="file" name="image" id="image">
              </div>
              <div class="form">
                <label for="name" class="label-form">Name</label>
                <input type="text" name="name" id="name" required placeholder="Enter Name Here" value="<?php echo $name; ?>">
              </div>
              <div class="form">
                <label for="description" class="label-form">Description</label>
                <input type="text" name="description" id="description" required placeholder="Enter Description Here" value="<?php echo $description; ?>">
              </div>
              <div class="form">
                <label for="price" class="label-form">Price</label>
                <input type="text" name="price" id="price" required placeholder="Enter Price Here" value="<?php echo $price; ?>">
              </div>
              <div class="form">
                <label class="label-form">Type</label>
                <div class="radio">
                  <input type="radio" id="food" name="type" value="0" <?php if ($type == '0') {
                                                                        echo 'checked';
                                                                      } ?>>
                  <label for="food" style="padding-left: 10px;">Food</label>
                </div>
                <div class="radio">
                  <input type="radio" id="beverages" name="type" value="1" <?php if ($type == '1') {
                                                                              echo 'checked';
                                                                            } ?>>
                  <label for="beverages" style="padding-left: 10px;">Beverages</label>
                </div>
              </div>
              <div class="submit">
                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                <button type="submit" class="button" name="update">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>