<?php

$databaseHost = 'localhost';
$databaseName = 'tugas_crud_php';
$databaseUsername = 'root';
$databasePassword = '';

$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

define('base_url', 'http://localhost/tugas/tugas-crud');

function rupiah($angka)
{
  $hasil_rupiah = "Rp" . number_format($angka, 0, ',', '.');
  return $hasil_rupiah;
}
