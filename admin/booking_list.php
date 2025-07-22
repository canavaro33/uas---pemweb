<?php
session_start();
include '../includes/db.php';

$query = "
    SELECT booking.*, homestay.nama AS nama_homestay
    FROM booking
    JOIN homestay ON booking.homestay_id = homestay.id
    ORDER BY booking.created_at DESC
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2 class="mb-4">Daftar Booking</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Homestay</th>
                <th>Nama Pemesan</th>
                <th>Email</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Catatan</th>
                <th>Dibuat</th>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['nama_homestay']); ?></td>
                <td><?= htmlspecialchars($row['nama_pemesan']); ?></td>
                <td><?= htmlspecialchars($row['email']); ?></td>
                <td><?= $row['tanggal_mulai']; ?></td>
                <td><?= $row['tanggal_selesai']; ?></td>
                <td><?= htmlspecialchars($row['catatan']); ?></td>
                <td><?= $row['created_at']; ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
