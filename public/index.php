<?php
include '../koneksi.php';
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$query = "SELECT * FROM homestay";
if ($search != '') {
    $query .= " WHERE nama LIKE '%$search%' OR lokasi LIKE '%$search%'";
}
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <p class="lead">Homestay List</p>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: rgba(157, 206, 187, 1);
        }
        .card {
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .homestay-img {
            height: 200px;
            object-fit: cover;
        }
        .hero {
            background: url('https://images.unsplash.com/photo-1501117716987-c8e1ecb210d6') no-repeat center center/cover;
            color: white;
            padding: 120px 0;
            text-shadow: 1px 1px 5px rgba(0,0,0,0.7);
        }
        footer {
            background: #343a40;
            color: #fff;
            padding: 20px 0;
        }
        footer a {
            color: #adb5bd;
            text-decoration: none;
        }
        footer a:hover {
            color: white;
        }
    </style>
</head>
<body>

    <!-- Hero / Landing Banner -->
    <div class="hero text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">This is RIM Homestay</h1>
            <p class="lead">Find the best place to stay with affordable prices and the best facilities!</p>
            <a href="#daftar" class="btn btn-light btn-lg mt-3">Lihat Homestay</a>
        </div>
    </div>

    <!-- Daftar Homestay -->
    <div class="container py-5" id="daftar">
        <!-- Search Box -->
<form method="GET" class="input-group mb-4">
    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama atau lokasi..." value="<?= htmlspecialchars($search); ?>">
    <button type="submit" class="btn btn-primary">Cari</button>
</form>

        <h2 class="text-center mb-4">Homestay List
        </h2>
        <div class="row g-4">
            <?php if (mysqli_num_rows($result) > 0): ?>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <div class="col-md-4">
            <div class="card">
                <img src="../uploads/<?= $row['gambar']; ?>" class="card-img-top homestay-img" alt="<?= $row['nama']; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($row['nama']); ?></h5>
                    <p class="card-text"><strong>Lokasi:</strong> <?= htmlspecialchars($row['lokasi']); ?></p>
                    <p class="card-text"><strong>Harga:</strong> Rp <?= number_format($row['harga']); ?>/malam</p>
                    <p class="card-text"><?= htmlspecialchars($row['deskripsi']); ?></p>
                    <p class="card-text"><small><strong>Fasilitas:</strong> <?= htmlspecialchars($row['fasilitas']); ?></small></p>
                    <a href="booking.php?id=<?= $row['id']; ?>" class="btn btn-success w-100 mt-2">Booking Sekarang</a>

                </div>
            </div>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <div class="col-12 text-center">
        <p class="text-muted">Homestay tidak ditemukan untuk kata kunci: <strong><?= htmlspecialchars($search); ?></strong></p>
    </div>
<?php endif; ?>

        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p class="mb-1">© <?= date("Y"); ?> RIMHomestay. All rights reserved.</p>
            <p class="mb-0">Contact: <a href="mailto:info@homestayku.com">info@rimhomestay.com</a></p>
        </div>
    </footer>

</body>
</html>
