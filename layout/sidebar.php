<?php

$url = base_url;
$query = mysqli_query($mysqli, "SELECT * FROM users WHERE id = '$_COOKIE[user_login]'");
$data = mysqli_fetch_object($query);

if ($data->role == 1) {
  $show = '';
} else {
  $show = 'd-none';
}

$sidebar = <<<EOD
          <div class="sidenav">
            <div>
              <a href="$url/index.php" class="title-navbar">Cafe Cak Agit</a>
              <a class="$show" href="$url/account/account.php">Account</a>
              <a href="$url/menu/menu.php">Food & Beverages</a>
            </div>
            <div class="logout">
              <a href="$url/settings/logout.php">Log Out</a>
            </div>
          </div>
        EOD;
