<?php

include_once("../settings/config.php");

$roleResult = mysqli_query($mysqli, "SELECT * FROM users WHERE id = '$_COOKIE[user_login]'");

$role = mysqli_fetch_object($roleResult);

if (!isset($_COOKIE['user_login'])) {
  header('Location: ../login.php');
} else if ($role->role != 1) {
  header('Location: ../index.php');
}

if (isset($_POST['update'])) {
  $id = $_POST['id'];

  $name = $_POST['name'];
  $username = $_POST['username'];
  if (isset($_POST['role'])) {
    $role = 1;
  } else {
    $role = 0;
  }

  $result = mysqli_query($mysqli, "UPDATE users SET username='$username',name='$name', role='$role' WHERE id=$id");

  header("Location: account.php");
}
?>
<?php

$id = $_GET['id'];

$result = mysqli_query($mysqli, "SELECT * FROM users WHERE id='$id'");

while ($user_data = mysqli_fetch_array($result)) {
  $name = $user_data['name'];
  $username = $user_data['username'];
  $role = $user_data['role'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Account | Dashboard Admin</title>

  <!-- style -->
  <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
  <div class="container" style="display: flex; justify-content: center; align-items: center;">
    <div class="half">
      <div class="anu">
        <h2 style="padding: 0 0 10px 20px;">
          <a href="account.php" class="instead">Back</a>
        </h2>

        <div class="card" style="display: flex; justify-content: center; align-items: center;">
          <div class="card-content">
            <div class="title">
              <h1 style="margin-top: 0;">Edit Account</h1>
              <p style="font-weight: 600;">
                <label style="color: red;">*</label>Password Cannot be Changed !
              </p>
            </div>
            <form action="edit.php" method="post" name="edit_user">
              <div class="form">
                <label for="name" class="label-form">Name</label>
                <input type="text" name="name" id="name" required placeholder="Enter Name Here" value="<?php echo $name; ?>">
              </div>
              <div class="form">
                <label for="username" class="label-form">Username</label>
                <input type="text" name="username" id="username" required placeholder="Enter Username Here" value="<?php echo $username; ?>">
              </div>
              <div class="form">
                <label class="label-form">Super Admin</label>
                <label class="toggler-wrapper style-1" style="padding: 0;">
                  <input type="checkbox" name="role" <?php if ($role == 1) {
                                                        echo 'checked';
                                                      } ?>>
                  <div class="toggler-slider">
                    <div class="toggler-knob"></div>
                  </div>
                </label>
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