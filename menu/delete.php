<?php

include_once("../settings/config.php");

$id = $_GET['id'];

$result = mysqli_query($mysqli, "DELETE FROM menus WHERE id=$id");

$_POST['alert'] = 'yes';

if (!isset($_COOKIE['user_login'])) {
  header('Location: ../login.php');
}

header("Location:menu.php");
