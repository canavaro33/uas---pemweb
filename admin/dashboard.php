<?php
session_start();
include '../includes/db.php';

// Pastikan user sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$query = mysqli_query($conn, "SELECT * FROM homestay");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ccc; }
        th { background-color: #eee; }
        a { text-decoration: none; color: blue; }
    </style>
</head>
<body>
    <h2>Dashboard Admin</h2>
    <p>Selamat datang, <?= $_SESSION['admin']; ?> | <a href="logout.php">Logout</a></p> 

    <p><a href="/uas---pemweb/admin/homestay_tambah.php">Tambah Homestay</a>
    
><a href="/uas---pemweb/admin/booking_list.php" class="btn btn-secondary">Lihat Booking</a></p>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Homestay</th>
            <th>Lokasi</th>
            <th>Harga per Malam</th>
            <th>Aksi</th>
        </tr>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($query)) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['lokasi']; ?></td>
            <td>Rp <?= number_format($row['harga']); ?></td>
            <td>
                <a href="/uas---pemweb/admin/homestay_edit.php?id=<?= $row['id']; ?>">Edit</a> |
                <a href="/uas---pemweb/admin/homestay_hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                

                

            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
