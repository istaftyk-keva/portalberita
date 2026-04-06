<?php
include 'config/koneksi.php';

// ambil semua kategori
$kategori = $conn->query("SELECT * FROM kategori");

// cek kategori yang dipilih
$id_kategori = isset($_GET['id']) ? intval($_GET['id']) : 0;

// ambil artikel berdasarkan kategori
if($id_kategori > 0){
    $artikel = $conn->query("SELECT * FROM artikel WHERE id_kategori = $id_kategori ORDER BY tanggal DESC");
} else {
    $artikel = $conn->query("SELECT * FROM artikel ORDER BY tanggal DESC");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Kategori Artikel</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
    background: #f4f6f9;
}

.navbar {
    background: #4e54c8;
}

.navbar a {
    color: white !important;
}

.card {
    border: none;
    border-radius: 15px;
}

.kategori-btn {
    margin: 5px;
}

.kategori-btn a {
    text-decoration: none;
}
</style>

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand text-white" href="home.php">Portal Berita</a>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="home.php"><i class="bi bi-house"></i> Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="kategori.php"><i class="bi bi-tags"></i> Kategori</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="artikel.php"><i class="bi bi-newspaper"></i> Artikel</a>
            </li>
        </ul>
    </div>
</nav>

<!-- HEADER -->
<div class="container mt-4">
    <div class="p-4 bg-white rounded shadow-sm mb-3">
        <h3><i class="bi bi-tags"></i> Kategori Berita</h3>
        <p class="text-muted">Pilih kategori untuk melihat artikel</p>
    </div>

    <!-- LIST KATEGORI -->
    <div class="mb-4">
        <a href="kategori.php" class="btn btn-secondary kategori-btn">Semua</a>

        <?php while($k = $kategori->fetch_assoc()){ ?>
            <a href="kategori.php?id=<?= $k['id_kategori'] ?>" 
               class="btn btn-primary kategori-btn">
                <?= $k['nama_kategori'] ?>
            </a>
        <?php } ?>
    </div>
</div>

<!-- ARTIKEL -->
<div class="container">
    <div class="row">

    <?php if($artikel->num_rows > 0){ ?>

        <?php while($row = $artikel->fetch_assoc()){ ?>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">

                <?php if(!empty($row['gambar'])){ ?>
                    <img src="upload/<?= $row['gambar'] ?>" style="height:200px;object-fit:cover;border-radius:15px 15px 0 0;">
                <?php } ?>

                <div class="card-body">

                    <h5><?= $row['judul'] ?></h5>

                    <p class="text-muted">
                        <i class="bi bi-calendar"></i>
                        <?= date('d M Y', strtotime($row['tanggal'])) ?>
                    </p>

                    <p><?= substr($row['isi'],0,100) ?>...</p>

                    <a href="detail.php?id=<?= $row['id_artikel'] ?>" class="btn btn-primary btn-sm">
                        Baca Selengkapnya
                    </a>

                </div>

            </div>
        </div>

        <?php } ?>

    <?php } else { ?>

        <div class="col-12">
            <div class="alert alert-warning text-center">
                Tidak ada artikel di kategori ini 😢
            </div>
        </div>

    <?php } ?>

    </div>
</div>

<footer class="text-white mt-5 pt-4 pb-3" style="background: linear-gradient(135deg, #4e54c8, #8f94fb);">
    <div class="container text-center">

        <h5>Portal Berita</h5>
        <p class="text-light">Menyajikan berita terbaru dan terpercaya</p>

        <div class="mb-2">
            <a href="home.php" class="text-white me-3">Home</a>
            <a href="kategori.php" class="text-white me-3">Kategori</a>
            <a href="artikel.php" class="text-white">Artikel</a>
        </div>

        <small>© <?= date('Y') ?> Portal Berita | Dibuat dengan ❤️</small>

    </div>
</footer>

</body>
</html>