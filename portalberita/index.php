<?php
include 'config/koneksi.php';

// ambil semua artikel
$artikel = $conn->query("SELECT * FROM artikel ORDER BY tanggal DESC");

// trending
$trending = $conn->query("SELECT * FROM artikel ORDER BY views DESC LIMIT 5");
?>

<!DOCTYPE html>
<html>
<head>
<title>Home - Portal Berita</title>

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

.card img {
    border-radius: 15px 15px 0 0;
}

.section-title {
    font-weight: bold;
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
                <a class="nav-link active" href="home.php">
                    <i class="bi bi-house"></i> Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="kategori.php">
                    <i class="bi bi-tags"></i> Kategori
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="artikel.php">
                    <i class="bi bi-newspaper"></i> Artikel
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- HEADER -->
<div class="container mt-4">
    <div class="p-4 bg-white rounded shadow-sm mb-4">
        <h3><i class="bi bi-newspaper"></i> Portal Berita</h3>
        <p class="text-muted">Berita terbaru, terpercaya, dan up-to-date</p>
    </div>
</div>

<!-- CONTENT -->
<div class="container">
    <div class="row">

        <!-- ARTIKEL -->
        <div class="col-md-8">

            <h4 class="section-title mb-3">📰 Berita Terbaru</h4>

            <div class="row">
            <?php while($row = $artikel->fetch_assoc()){ ?>

                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">

                        <?php if(!empty($row['gambar'])){ ?>
                            <img src="upload/<?= $row['gambar'] ?>" style="height:200px;object-fit:cover;">
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
            </div>

        </div>

        <!-- SIDEBAR -->
        <div class="col-md-4">

            <h5 class="mb-3">🔥 Trending</h5>

            <div class="card p-3 shadow-sm">

                <?php while($t = $trending->fetch_assoc()){ ?>
                    <p class="mb-2">
                        <a href="detail.php?id=<?= $t['id_artikel'] ?>" class="text-decoration-none">
                            <?= $t['judul'] ?>
                        </a>
                    </p>
                <?php } ?>

            </div>

        </div>

    </div>
</div>

<!-- FOOTER -->
<footer class="text-white mt-5 pt-4 pb-3" style="background: linear-gradient(135deg, #4e54c8, #8f94fb);">
    <div class="container text-center">

        <h5>Portal Berita</h5>
        <p class="text-light">Menyajikan berita terbaru dan terpercaya</p>

        <div class="mb-2">
            <a href="home.php" class="text-white me-3">Home</a>
            <a href="kategori.php" class="text-white me-3">Kategori</a>
            <a href="artikel.php" class="text-white">Artikel</a>
        </div>

        <small>© <?= date('Y') ?> Portal Berita</small>

    </div>
</footer>

</body>
</html>