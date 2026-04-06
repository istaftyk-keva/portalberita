<?php
include __DIR__ . '/../config/koneksi.php';
include __DIR__ . '/../layout/header.php';

if(isset($_POST['simpan'])){
    $nama = $_POST['nama'];

    $stmt = $conn->prepare("INSERT INTO kategori (nama_kategori) VALUES (?)");
    $stmt->bind_param("s", $nama);
    $stmt->execute();

    header("Location: kategori.php");
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">

<div class="card shadow p-4 col-md-6 mx-auto">

<h4 class="fw-bold mb-3">Tambah Kategori</h4>

<form method="POST">

<label>Nama Kategori</label>
<input type="text" name="nama" class="form-control mb-3" required>

<button name="simpan" class="btn btn-success">Simpan</button>
<a href="kategori.php" class="btn btn-secondary">Kembali</a>

</form>

</div>

</div>