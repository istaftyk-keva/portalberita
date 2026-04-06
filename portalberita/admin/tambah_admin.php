<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-4">
<h3>Tambah Admin</h3>

<form method="POST" action="simpan_admin.php">
    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <button class="btn btn-primary">Simpan</button>
</form>
</div>