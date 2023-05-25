<?php

setcookie('user_login', '', time() - 7200, '/');

session_unset();
session_destroy();

header('Location: ../login.php');
