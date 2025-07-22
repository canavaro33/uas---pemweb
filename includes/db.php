<?php
$host = 'localhost';      // Server database
$user = 'root';           // Username default XAMPP
$pass = '';       // Password MySQL kamu
$db   = 'homestay_db';    // Nama database kamu

// Membuat koneksi
$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>
