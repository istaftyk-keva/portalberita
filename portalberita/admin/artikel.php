<?php
include '../config/koneksi.php';
$data = $conn->query("SELECT * FROM artikel");
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">

<h3 class="fw-bold mb-3">Data Artikel</h3>

    <button onclick=history.back() class="btn btn-secondary mb-3"> Kembali </button>
    <a href="tambah_Artikel.php" class="btn btn-primary mb-3"> Tambah Artikel</a>
    

<table class="table table-bordered table-hover shadow-sm align-middle">

<thead class="table-dark text-center">
<tr>
<th>No</th>
<th>Gambar</th>
<th>Judul</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>

<?php 
$no = 1;
while($d = $data->fetch_assoc()){ 

    $img = "../uploads/" . $d['gambar'];
?>

<tr>
<td class="text-center"><?= $no++ ?></td>

<td class="text-center">
    <img src="../img<?= $row['gambar'] ?>" width="80">
</td>

<td><?= $d['judul'] ?></td>

<td class="text-center">
    <a href="edit_artikel.php?id=<?= $d['id_artikel'] ?>" class="btn btn-warning btn-sm">Edit</a>
    <a href="hapus_artikel.php?id=<?= $d['id_artikel'] ?>" class="btn btn-danger btn-sm">Hapus</a>
</td>

</tr>

<?php } ?>

</tbody>
</table>

</div>