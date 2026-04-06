<?php
include '../config/koneksi.php';

$id = $_GET['id'];

// ambil data lama
$stmt = $conn->prepare("SELECT * FROM artikel WHERE id_artikel=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

// ambil kategori
$kategori = $conn->query("SELECT * FROM kategori");

// proses update
if(isset($_POST['update'])){

    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $id_kategori = $_POST['kategori'];

    // cek upload gambar
    if($_FILES['gambar']['name'] != ""){
        $gambar = $_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../uploads/".$gambar);

        $stmt = $conn->prepare("UPDATE artikel SET judul=?, isi=?, id_kategori=?, gambar=? WHERE id_artikel=?");
        $stmt->bind_param("ssisi", $judul, $isi, $id_kategori, $gambar, $id);
    } else {
        $stmt = $conn->prepare("UPDATE artikel SET judul=?, isi=?, id_kategori=? WHERE id_artikel=?");
        $stmt->bind_param("ssii", $judul, $isi, $id_kategori, $id);
    }

    $stmt->execute();

    header("Location: artikel.php");
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">

<div class="card shadow p-4">
<h4 class="fw-bold mb-3">Edit Artikel</h4>

<form method="POST" enctype="multipart/form-data">

<input type="text" name="judul" class="form-control mb-3" value="<?= $data['judul'] ?>">

<textarea name="isi" class="form-control mb-3" rows="5"><?= $data['isi'] ?></textarea>

<select name="kategori" class="form-control mb-3">
<?php while($k=$kategori->fetch_assoc()){ ?>
<option value="<?= $k['id_kategori'] ?>" 
<?= ($k['id_kategori']==$data['id_kategori']) ? 'selected' : '' ?>>
<?= $k['nama_kategori'] ?>
</option>
<?php } ?>
</select>

<!-- gambar lama -->
<p>Gambar sekarang:</p>
<img src="../uploads/<?= $data['gambar'] ?>" width="120" class="mb-3">

<input type="file" name="gambar" class="form-control mb-3">

<button name="update" class="btn btn-primary">Update</button>
<a href="artikel.php" class="btn btn-secondary">Kembali</a>

</form>

</div>
</div>