<?php 
$host = "localhost";
$username = "root";
$password = "";
$db = "db_lsp";

$koneksi = mysqli_connect($host, $username, $password, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_errno());
}
?>