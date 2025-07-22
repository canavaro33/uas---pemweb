<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil nama file gambar terlebih dahulu
    $queryGambar = "SELECT gambar FROM homestay WHERE id = $id";
    $resultGambar = mysqli_query($conn, $queryGambar);
    $dataGambar = mysqli_fetch_assoc($resultGambar);

    if ($dataGambar) {
        $gambarPath = "../uploads/" . $dataGambar['gambar'];
        if (file_exists($gambarPath)) {
            unlink($gambarPath); // Hapus file gambar dari folder
        }
    }

    // Hapus data dari database
    $query = "DELETE FROM homestay WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Gagal menghapus data!";
    }
} else {
    echo "ID tidak ditemukan!";
}
?>
