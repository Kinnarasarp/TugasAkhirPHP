<?php

include_once("../settings/config.php");

$id = $_GET['id'];

$result = mysqli_query($mysqli, "DELETE FROM users WHERE id=$id");

$_POST['alert'] = 'yes';

$roleResult = mysqli_query($mysqli, "SELECT * FROM users WHERE id = '$_COOKIE[user_login]'");

$role = mysqli_fetch_object($roleResult);

if (!isset($_COOKIE['user_login'])) {
  header('Location: ../login.php');
} else if ($role->role != 1) {
  header('Location: ../index.php');
}

header("Location:account.php");
