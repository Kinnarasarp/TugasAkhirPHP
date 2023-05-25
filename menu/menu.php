<?php

include_once("../settings/config.php");
include '../layout/sidebar.php';
$result = mysqli_query($mysqli, "SELECT * FROM menus");

if (!isset($_COOKIE['user_login'])) {
  header('Location: ../login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=`device-width`, initial-scale=1.0">
  <title>Food & Beverages | Dashboard Admin</title>

  <!-- style -->
  <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
  <?= $sidebar ?>
  <div class="container" style="margin-left: 250px;">
    <div class="page-header">
      <h1 style="margin: 0;">Food & Beverages</h1>
      <a href="add.php">
        <button class="button" style="width: auto;">
          Create Menu
        </button>
      </a>
    </div>

    <table class="table-custom">
      <tr class="table-header">
        <th>#</th>
        <th>Name</th>
        <th>Type</th>
        <th>Price</th>
        <th>Action</th>
      </tr>
      <?php

      $data = [];
      while ($user_data = mysqli_fetch_assoc($result)) {

        $data[] = $user_data;
      }

      count($data);

      $urutan = 1;

      ?>

      <?php if (count($data) == 0) : ?>
        <tr>
          <td class="table-data" colspan="6"><b>No Data Available</b></td>
        </tr>

        <?php else : foreach ($data as $row) : ?>
          <tr class="table-row">
            <td class="table-data"><?= $urutan ?></td>
            <td class="table-data"><?= $row['name'] ?></td>
            <td class="table-data"><?php if ($row['type'] == 0) {
                                      echo "Food";
                                    } else {
                                      echo "Beverage";
                                    } ?>
            </td>
            <td class="table-data"><?= rupiah($row['price']) ?></td>
            <td class="table-data" style="width: 35%;">
              <div>
                <a href="detail.php?id=<?= $row["id"] ?>">
                  <button class="button action-button">Detail</button>
                </a>
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
      <?php endif; ?>
    </table>
  </div>
</body>

</html>