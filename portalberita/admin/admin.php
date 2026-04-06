<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit;
}

include __DIR__ . '/../config/koneksi.php';
include __DIR__ . '/../layout/header.php';

$data = $conn->query("SELECT * FROM admin ORDER BY id_admin DESC");
?>

<div class="container mt-4">

<h3 class="fw-bold mb-3">👤 Manajemen Admin</h3>

<button onclick=history.back() class="btn btn-secondary mb-3"> Kembali </button>
<a href="tambah_admin.php" class="btn btn-primary mb-3"> Tambah Admin</a>

<table class="table table-bordered table-striped">

<thead class="table-dark text-center">
<tr>
<th>No</th>
<th>Username</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>

<?php $no=1; while($row = $data->fetch_assoc()): ?>
<tr>
<td class="text-center"><?= $no++ ?></td>
<td><?= htmlspecialchars($row['username']) ?></td>
<td class="text-center">

<a href="edit_admin.php?id=<?= (int)$row['id_admin'] ?>" class="btn btn-warning btn-sm">Edit</a>

<a href="hapus_admin.php?id=<?= (int)$row['id_admin'] ?>" 
   class="btn btn-danger btn-sm"
   onclick="return confirm('Yakin hapus admin ini?')">
   Hapus
</a>

</td>
</tr>
<?php endwhile; ?>

</tbody>
</table>

</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>