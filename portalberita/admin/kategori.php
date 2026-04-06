<?php
include '../config/koneksi.php';
$data = $conn->query("SELECT * FROM kategori");
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">

<h3 class="fw-bold mb-3">Data Kategori</h3>

<button onclick="history.back()" class="btn btn-secondary mb-3">Kembali</button>
<a href="tambah_kategori.php" class="btn btn-primary mb-3"> Tambah Kategori</a>

<table class="table table-bordered table-hover shadow-sm align-middle">

<thead class="table-dark text-center">
<tr>
    <th>No</th>
    <th>Gambar</th>
    <th>Nama Kategori</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>

<?php 
$no = 1;
while($k = $data->fetch_assoc()){ 

    // FIX PATH GAMBAR
    $img = !empty($k['gambar']) ? "../uploads/kategori/" . $k['gambar'] : "https://via.placeholder.com/80";
?>

<tr>

<td class="text-center"><?= $no++ ?></td>

<td class="text-center">
    <img src="<?= $img ?>" width="80" height="80" 
         style="object-fit:cover;" 
         onerror="this.src='https://via.placeholder.com/80'">
</td>

<td><?= htmlspecialchars($k['nama_kategori']) ?></td>

<td class="text-center">
    <a href="edit_kategori.php?id=<?= $k['id_kategori'] ?>" class="btn btn-warning btn-sm">Edit</a>
    <a href="hapus_kategori.php?id=<?= $k['id_kategori'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
</td>

</tr>

<?php } ?>

</tbody>
</table>

</div>