<?php
include 'config/koneksi.php';

// validasi id
if(!isset($_GET['id']) || empty($_GET['id'])){
    die("Artikel tidak ditemukan!");
}

$id = intval($_GET['id']);

// update views
$stmt = $conn->prepare("UPDATE artikel SET views = views + 1 WHERE id_artikel = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

// ambil artikel + join kategori
$stmt = $conn->prepare("
    SELECT artikel.*, kategori.nama_kategori 
    FROM artikel 
    LEFT JOIN kategori ON artikel.id_kategori = kategori.id_kategori 
    WHERE id_artikel = ?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 0){
    die("Artikel tidak ditemukan!");
}

$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title><?= $data['judul'] ?></title>

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

.article-img {
    width: 100%;
    height: 400px;
    object-fit: cover;
    border-radius: 15px;
}

.content-box {
    background: white;
    padding: 25px;
    border-radius: 15px;
}

</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand text-white" href="home.php">Portal Berita</a>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="kategori.php">Kategori</a></li>
            <li class="nav-item"><a class="nav-link" href="artikel.php">Artikel</a></li>
        </ul>
    </div>
</nav>

<!-- CONTENT -->
<div class="container mt-4">

<div class="content-box shadow-sm">

    <h2><?= $data['judul'] ?></h2>

    <p class="text-muted">
        <i class="bi bi-calendar"></i>
        <?= date('d M Y', strtotime($data['tanggal'])) ?>
        |
        <i class="bi bi-eye"></i>
        <?= $data['views'] ?>x
        |
        <i class="bi bi-tags"></i>
        <?= $data['nama_kategori'] ?? 'Umum' ?>
    </p>

    <?php if(!empty($data['gambar'])){ ?>
        <img src="upload/<?= $data['gambar'] ?>" class="article-img mb-3">
    <?php } ?>

    <div style="line-height:1.8;">
        <?= nl2br($data['isi']) ?>
    </div>

    <a href="artikel.php" class="btn btn-secondary mt-4">
        ← Kembali ke Artikel
    </a>

</div>

</div>

</body>
</html>