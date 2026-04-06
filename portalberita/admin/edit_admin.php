<?php
include '../config/koneksi.php';
$id = (int)$_GET['id'];

$data = $conn->query("SELECT * FROM admin WHERE id_admin=$id")->fetch_assoc();
?>

<div class="container mt-4">
<h3>Edit Admin</h3>

<form method="POST" action="update_admin.php">
<input type="hidden" name="id" value="<?= $id ?>">

<div class="mb-3">
<label>Username</label>
<input type="text" name="username" value="<?= $data['username'] ?>" class="form-control">
</div>

<div class="mb-3">
<label>Password Baru (kosongkan jika tidak diubah)</label>
<input type="password" name="password" class="form-control">
</div>

<button class="btn btn-success">Update</button>
</form>
</div>