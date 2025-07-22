<?php
session_start();
include '../includes/db.php';

if (isset($_GET['id'])) {
    $homestay_id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM homestay WHERE id = $homestay_id");
    $homestay = mysqli_fetch_assoc($result);
} else {
    echo "Homestay tidak ditemukan.";
    exit;
}

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];
    $tamu = $_POST['tamu'];
    $catatan = $_POST['catatan'];
    $email = $_POST['email'];

    $query = "INSERT INTO booking (homestay_id, nama_pemesan, tanggal_mulai, tanggal_selesai, jumlah_tamu, catatan)
              VALUES ('$homestay_id', '$nama', '$tanggal_mulai', '$tanggal_selesai', '$tamu', '$catatan')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Booking berhasil!'); window.location.href='index.php';</script>";
    } else {
        echo "Gagal booking.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Booking Homestay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4">Booking: <?= htmlspecialchars($homestay['nama']); ?></h2>
        <form method="POST">
            <div class="mb-3">
                <label>Nama Pemesan:</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>tanggal_mulai:</label>
                <input type="date" name="checkin" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>tanggal_selesai:</label>
                <input type="date" name="checkout" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Jumlah Tamu:</label>
                <input type="number" name="tamu" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Catatan Tambahan:</label>
                <textarea name="catatan" class="form-control"></textarea>
            </div>

            <label>Email:</label>
                <input type="text" name="email" class="form-control" required>
            </div>
</div>

            <button type="submit" name="submit" class="btn btn-primary">Kirim Booking</button>
        </form>
    </div>
</body>
</html>
