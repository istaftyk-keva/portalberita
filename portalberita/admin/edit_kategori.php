<?php
include '../config/koneksi.php';

$id = $_GET['id'];

$data = $conn->query("SELECT * FROM kategori WHERE id_kategori=$id")->fetch_assoc();

if(isset($_POST['update'])){
    $nama = $_POST['nama'];

    $stmt = $conn->prepare("UPDATE kategori SET nama_kategori=? WHERE id_kategori=?");
    $stmt->bind_param("si", $nama, $id);
    $stmt->execute();

    header("Location: kategori.php");
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">

<div class="card shadow p-4 col-md-6 mx-auto">

<h4>Edit Kategori</h4>

<form method="POST">

<input type="text" name="nama" value="<?= $data['nama_kategori'] ?>" class="form-control mb-3">

<button name="update" class="btn btn-warning">Update</button>

</form>

</div>
</div>