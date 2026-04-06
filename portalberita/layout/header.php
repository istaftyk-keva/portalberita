<!DOCTYPE html>
<html>
<head>
<title>Portal Berita</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
    background-color: #f5f7fa;
    font-family: 'Segoe UI', sans-serif;
}

/* navbar gradient */
.navbar-custom {
    background: linear-gradient(45deg, #4e54c8, #8f94fb);
}

/* hover navbar */
.nav-link {
    transition: 0.3s;
}
.nav-link:hover {
    color: #ffd369 !important;
}

/* card berita */
.card-hover {
    border-radius: 15px;
    overflow: hidden;
}
.card-hover:hover {
    transform: translateY(-5px);
    transition: 0.3s;
}

/* trending box */
.trending-box {
    background: white;
    border-radius: 15px;
    padding: 15px;
}

/* judul section */
.section-title {
    font-weight: bold;
    border-left: 5px solid #4e54c8;
    padding-left: 10px;
}

/* search box */
.search-box input {
    border-radius: 20px;
}

/* shadow lebih halus */
.shadow-sm {
    box-shadow: 0 4px 10px rgba(0,0,0,0.05) !important;
}
</style>

</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm">
<div class="container">

    <!-- Logo -->
    <a class="navbar-brand fw-bold" href="index.php">
        📰 Portal Berita
    </a>

    <!-- Toggle mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu -->
    <div class="collapse navbar-collapse" id="navbarNav">

        <ul class="navbar-nav ms-auto align-items-center">

            <ul class="navbar-nav ms-auto align-items-center gap-2">

    <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2" href="index.php">
            <i class="bi bi-house"></i>
            <span>Home</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2" href="dashboard.php">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2" href="kategori.php">
            <i class="bi bi-tags"></i>
            <span>Kategori</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2" href="artikel.php">
            <i class="bi bi-newspaper"></i>
            <span>Artikel</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2 text-warning" href="logout.php">
            <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>
        </a>
    </li>

</ul>
            

            <!-- Search -->
            <li class="nav-item ms-3">
                <form class="d-flex search-box" action="index.php" method="GET">
                    <input class="form-control me-2" type="search" name="cari" placeholder="Cari berita...">
                    <button class="btn btn-light" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </li>

        </ul>
    </div>

</div>
</nav>

<div class="container mt-4">