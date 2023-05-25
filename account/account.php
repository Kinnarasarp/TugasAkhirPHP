<?php

include_once("../settings/config.php");
include '../layout/sidebar.php';
$result = mysqli_query($mysqli, "SELECT * FROM users");

$roleResult = mysqli_query($mysqli, "SELECT * FROM users WHERE id = '$_COOKIE[user_login]'");

$role = mysqli_fetch_object($roleResult);

if (!isset($_COOKIE['user_login'])) {
  header('Location: ../login.php');
} else if ($role->role != 1) {
  header('Location: ../index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=`device-width`, initial-scale=1.0">
  <title>Account | Dashboard Admin</title>

  <!-- style -->
  <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
  <?= $sidebar ?>
  <div class="container" style="margin-left: 250px;">
    <div class="page-header">
      <h1 style="margin: 0;">Account</h1>
    </div>

    <table class="table-custom">
      <tr class="table-header">
        <th>#</th>
        <th>Name</th>
        <th>Username</th>
        <th>Role</th>
        <th>Password</th>
        <th>Action</th>
      </tr>
      <?php

      $data = [];
      while ($user_data = mysqli_fetch_assoc($result)) {

        $data[] = $user_data;
      }

      $urutan = 1;

      ?>
      <?php foreach ($data as $row) : ?>
        <tr class="table-row">
          <td class="table-data"><?= $urutan ?></td>
          <td class="table-data"><?= $row['name'] ?></td>
          <td class="table-data"><?= $row['username'] ?></td>
          <td class="table-data"><?php if ($row['role'] == 0) {
                                    echo "Admin";
                                  } else {
                                    echo "Super Admin";
                                  } ?></td>
          <td class="table-data"><?= $row['password'] ?></td>
          <td class="table-data" style="width: 25%;">
            <div>
              <a href="edit.php?id=<?= $row["id"] ?>">
                <button class="button action-button">Edit</button>
              </a>
              <a href="delete.php?id=<?= $row["id"] ?>">
                <button class="button action-button">Delete</button>
              </a>
            </div>
          </td>
        </tr>
      <?php
        $urutan++;
      endforeach;
      ?>
    </table>
  </div>
</body>

</html>