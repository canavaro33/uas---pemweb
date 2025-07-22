<?php
require_once '../koneksi.php';



$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM homestay WHERE id = $id");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $lokasi = $_POST['lokasi'];
    $harga = $_POST['harga'];
    $fasilitas = $_POST['fasilitas'];
    $deskripsi = $_POST['deskripsi'];

    // Upload gambar jika diubah
    if ($_FILES['gambar']['name'] != '') {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        $uploadDir = "../uploads/";

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $path = $uploadDir . $gambar;
        move_uploaded_file($tmp, $path);
    } else {
        $gambar = $data['gambar']; // Pakai gambar lama
    }

    $update = "UPDATE homestay SET 
                nama = '$nama',
                lokasi = '$lokasi',
                harga = '$harga',
                fasilitas = '$fasilitas',
                gambar = '$gambar',
                deskripsi = '$deskripsi'
               WHERE id = $id";

    if (mysqli_query($conn, $update)) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Gagal memperbarui data!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Homestay</title>
</head>
<body>
    <h2>Edit Homestay</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Nama Homestay:</label><br>
        <input type="text" name="nama" value="<?= $data['nama'] ?>" required><br><br>

        <label>Lokasi:</label><br>
        <input type="text" name="lokasi" value="<?= $data['lokasi'] ?>" required><br><br>

        <label>Harga per Malam:</label><br>
        <input type="number" name="harga" value="<?= $data['harga'] ?>" required><br><br>

        <label>Fasilitas:</label><br>
        <textarea name="fasilitas" required><?= $data['fasilitas'] ?></textarea><br><br>

        <label>Deskripsi:</label><br>
        <textarea name="deskripsi" required><?= $data['deskripsi'] ?></textarea><br><br>

        <label>Gambar:</label><br>
        <input type="file" name="gambar" accept="image/*"><br>
        <small>Gambar saat ini: <?= $data['gambar'] ?></small><br><br>

        <button type="submit" name="submit">Simpan Perubahan</button>
    </form>
</body>
</html>
