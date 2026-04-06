<?php
session_start();
include '../config/koneksi.php';

// ======================
// SEARCH
// ======================
$keyword = isset($_GET['search']) ? trim($_GET['search']) : '';

if ($keyword !== '') {
    $stmt = $conn->prepare("SELECT * FROM artikel WHERE judul LIKE ? ORDER BY tanggal DESC");
    $search = "%$keyword%";
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $artikel = $stmt->get_result();
} else {
    $artikel = $conn->query("SELECT * FROM artikel ORDER BY tanggal DESC");
}

// ======================
// TRENDING
// ======================
$trending = $conn->query("SELECT * FROM artikel ORDER BY views DESC LIMIT 5");

// ======================
// FEATURED
// ======================
$featured = $conn->query("SELECT * FROM artikel ORDER BY tanggal DESC LIMIT 1")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Portal Berita</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body { background:#f4f6f9; }

/* NAVBAR */
.navbar {
    background: linear-gradient(135deg, #4e54c8, #8f94fb);
    padding: 12px 0;
}
.navbar a { color:white !important; }

/* FEATURED */
.featured {
    border-radius: 20px;
    overflow: hidden;
    position: relative;
    height: 300px;
    background: #ddd;
}
.featured img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.featured-text {
    position: absolute;
    bottom: 0;
    width: 100%;
    padding: 25px;
    color: white;
    background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
}

/* CARD */
.card {
    border-radius: 15px;
    transition: .3s;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}
.card-img-top {
    height: 200px;
    object-fit: cover;
}

/* FOOTER */
footer {
    background: linear-gradient(135deg, #4e54c8, #8f94fb);
}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg">
<div class="container">
<a class="navbar-brand text-white" href="index.php">Portal Berita</a>

<ul class="navbar-nav ms-auto">
<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
<li class="nav-item"><a class="nav-link" href="kategori.php">Kategori</a></li>
<li class="nav-item"><a class="nav-link" href="artikel.php">Artikel</a></li>

<?php if(isset($_SESSION['admin'])): ?>
<li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
<?php else: ?>
<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
<?php endif; ?>
</ul>

</div>
</nav>

<!-- CONTENT -->
<div class="container mt-4 mb-5">

<!-- FEATURED -->
<?php if($featured): ?>
<?php
$img = "https://via.placeholder.com/800x300";
if (!empty($featured['gambar']) && file_exists(__DIR__ . "/upload/" . $featured['gambar'])) {
    $img = "upload/" . $featured['gambar'];
}
?>
<div class="featured shadow mb-4">
    <img src="<?= $img ?>" alt="featured">
    <div class="featured-text">
        <h4><?= htmlspecialchars($featured['judul']) ?></h4>
        <a href="detail.php?id=<?= $featured['id_artikel'] ?>" class="btn btn-light btn-sm">Baca</a>
    </div>
</div>
<?php endif; ?>

<!-- SEARCH -->
<form method="GET" class="mb-4">
<div class="input-group">
<input type="text" name="search" class="form-control" placeholder="Cari berita..." value="<?= htmlspecialchars($keyword) ?>">
<button class="btn btn-primary">Cari</button>
</div>
</form>

<div class="row g-4">

<!-- ARTIKEL -->
<div class="col-md-8">

<h4 class="fw-bold mb-4">📰 Berita Terbaru</h4>

<div class="row g-4">
<?php if ($artikel && $artikel->num_rows > 0): ?>
<?php while ($row = $artikel->fetch_assoc()): ?>

<?php
$gambar = "https://via.placeholder.com/400x200";
if (!empty($row['gambar']) && file_exists(__DIR__ . "/upload/" . $row['gambar'])) {
    $gambar = "upload/" . $row['gambar'];
}
?>

<div class="col-md-6">
<div class="card h-100 shadow-sm">

<img src="<?= $gambar ?>" class="card-img-top" alt="gambar">

<div class="card-body d-flex flex-column">

<h6 class="fw-bold"><?= htmlspecialchars($row['judul']) ?></h6>

<small class="text-muted mb-2">
<?= date('d M Y', strtotime($row['tanggal'])) ?> | 👁 <?= $row['views'] ?>
</small>

<p class="flex-grow-1">
<?= substr(strip_tags($row['isi']),0,90) ?>...
</p>

<a href="detail.php?id=<?= $row['id_artikel'] ?>" class="btn btn-primary btn-sm mt-auto">
Baca
</a>

</div>
</div>
</div>

<?php endwhile; ?>
<?php endif; ?>
</div>

</div>

<!-- SIDEBAR -->
<div class="col-md-4">

<h5 class="fw-bold mb-3">🔥 Trending</h5>

<div class="card p-3 shadow-sm">
<?php while ($t = $trending->fetch_assoc()): ?>
<a href="detail.php?id=<?= $t['id_artikel'] ?>" class="d-block mb-3 text-decoration-none text-dark">
<strong><?= htmlspecialchars($t['judul']) ?></strong>
</a>
<?php endwhile; ?>
</div>

</div>

</div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>

</body>
</html>