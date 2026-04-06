<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit;
}

include __DIR__ . '/../layout/header.php';
?>

<style>
.dashboard-card {
    border-radius: 20px;
    transition: 0.3s;
}

.dashboard-card:hover {
    transform: translateY(-8px);
}

.icon-box {
    font-size: 40px;
    margin-bottom: 10px;
}

.welcome-box {
    background: linear-gradient(135deg, #4e54c8, #8f94fb);
    color: white;
    border-radius: 15px;
}
</style>

<div class="container mt-4">

<!-- WELCOME -->
<div class="p-4 mb-4 welcome-box shadow-sm">
    <h4>Halo, <?= $_SESSION['admin']; ?> 👋</h4>
    <p>Selamat datang di Dashboard Admin Portal Berita</p>
</div>

<h4 class="fw-bold mb-3">📊 Dashboard</h4>

<div class="row g-4">

<!-- ARTIKEL -->
<div class="col-md-4">
    <div class="card shadow dashboard-card text-center p-4">
        <div class="icon-box">📰</div>
        <h5>Artikel</h5>
        <p class="text-muted">Kelola berita yang ditampilkan</p>
        <a href="artikel.php" class="btn btn-primary">Kelola</a>
    </div>
</div>

<!-- KATEGORI -->
<div class="col-md-4">
    <div class="card shadow dashboard-card text-center p-4">
        <div class="icon-box">📂</div>
        <h5>Kategori</h5>
        <p class="text-muted">Atur kategori berita</p>
        <a href="kategori.php" class="btn btn-success">Kelola</a>
    </div>
</div>

<!-- ADMIN -->
<div class="col-md-4">
    <div class="card shadow dashboard-card text-center p-4">
        <div class="icon-box">👤</div>
        <h5>Admin</h5>
        <p class="text-muted">Kelola akun admin</p>
        <a href="admin.php" class="btn btn-warning">Kelola</a>
    </div>
</div>

<!-- LOGOUT -->
<div class="col-md-4">
    <div class="card shadow dashboard-card text-center p-4">
        <div class="icon-box">🚪</div>
        <h5>Logout</h5>
        <p class="text-muted">Keluar dari sistem admin</p>
        <a href="/logout.php" class="btn btn-danger mt-2">Keluar</a>
    </div>
</div>

</div>

</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>