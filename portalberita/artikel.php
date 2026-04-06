<?php
include 'config/koneksi.php';

$cari = isset($_GET['cari']) ? $_GET['cari'] : '';

if($cari != ''){
    $stmt = $conn->prepare("SELECT * FROM artikel WHERE judul LIKE ? ORDER BY tanggal DESC");
    $like = "%$cari%";
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM artikel ORDER BY tanggal DESC");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Semua Artikel</title>

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
    transition: 0.3s;
}

.card:hover {
    transform: translateY(-5px);
}

.card img {
    border-radius: 15px 15px 0 0;
    height: 200px;
    object-fit: cover;
}

.badge-custom {
    background: #4e54c8;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand text-white" href="home.php">Portal Berita</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="home.php"><i class="bi bi-house"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="kategori.php"><i class="bi bi-tags"></i> Kategori</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="artikel.php"><i class="bi bi-newspaper"></i> Artikel</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- HEADER -->
<div class="container mt-4">
    <div class="p-4 bg-white rounded shadow-sm mb-4">
        <h3>Semua Artikel 📰</h3>
        <p class="text-muted">Kumpulan berita terbaru dan terupdate</p>
    </div>
</div>

<?php if($cari != ''){ ?>
    <div class="alert alert-info">
        Hasil pencarian untuk: <b><?= $cari ?></b>
    </div>
<?php } ?>

<!-- LIST ARTIKEL -->
<div class="container">
    <div class="row">

    <?php while($row = $result->fetch_assoc()){ ?>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">

                <?php if(!empty($row['gambar'])){ ?>
                    <img src="upload/<?= $row['gambar'] ?>">
                <?php } ?>

                <div class="card-body">

                    <span class="badge badge-custom mb-2">
                        <i class="bi bi-eye"></i> <?= $row['views'] ?? 0 ?>
                    </span>

                    <h5><?= $row['judul'] ?></h5>

                    <p class="text-muted mb-1">
                        <i class="bi bi-calendar"></i>
                        <?= date('d M Y', strtotime($row['tanggal'])) ?>
                    </p>

                    <p>
                        <?= substr($row['isi'], 0, 100) ?>...
                    </p>

                    <a href="detail.php?id=<?= $row['id_artikel'] ?>" class="btn btn-primary btn-sm">
                        Baca Selengkapnya
                    </a>

                </div>

            </div>
        </div>

    <?php } ?>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

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