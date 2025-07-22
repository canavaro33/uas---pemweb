<?php
require_once '../koneksi.php';


if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $lokasi = $_POST['lokasi'];
    $harga = $_POST['harga'];
    $fasilitas = $_POST['fasilitas'];
    $deskripsi = $_POST['deskripsi'];

    // Upload gambar
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    $uploadDir = "../uploads/";

    // Pastikan folder upload ada
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $path = $uploadDir . $gambar;
    move_uploaded_file($tmp, $path);

    // Simpan ke database
    $query = "INSERT INTO homestay (nama, lokasi, harga, fasilitas, gambar, deskripsi) 
              VALUES ('$nama', '$lokasi', '$harga', '$fasilitas', '$gambar', '$deskripsi')";

    if (mysqli_query($conn, $query)) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Gagal menambahkan data!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Homestay</title>
</head>
<body>
    <h2>Tambah Homestay</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Nama Homestay:</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Lokasi:</label><br>
        <input type="text" name="lokasi" required><br><br>

        <label>Harga per Malam:</label><br>
        <input type="number" name="harga" required><br><br>

        <label>Fasilitas:</label><br>
        <textarea name="fasilitas" required></textarea><br><br>

        <label>Deskripsi:</label><br>
        <textarea name="deskripsi" required></textarea><br><br>

        <label>Gambar:</label><br>
        <input type="file" name="gambar" accept="image/*" required><br><br>

        <button type="submit" name="submit">Simpan</button>
    </form>
</body>
</html>

