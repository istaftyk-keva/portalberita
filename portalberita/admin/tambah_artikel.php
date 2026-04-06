<?php
include '../config/koneksi.php';

if(isset($_POST['simpan'])){
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $kategori = $_POST['kategori'];

    $gambar = $_FILES['gambar']['name'];
    move_uploaded_file($_FILES['gambar']['tmp_name'], "../upload/".$gambar);
    $stmt = $conn->prepare("INSERT INTO artikel (judul, isi, id_kategori, gambar) VALUES (?,?,?,?)");
    $stmt->bind_param("ssis", $judul, $isi, $kategori, $gambar);
    $stmt->execute();

    header("Location: artikel.php");
}

$kategori = $conn->query("SELECT * FROM kategori");
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">

<div class="card shadow p-4">
<h4 class="fw-bold mb-3">Tambah Artikel</h4>

<form method="POST" enctype="multipart/form-data">

<input type="text" name="judul" class="form-control mb-3" placeholder="Judul">

<textarea name="isi" class="form-control mb-3" rows="5" placeholder="Isi berita"></textarea>

<select name="kategori" class="form-control mb-3">
<?php while($k=$kategori->fetch_assoc()){ ?>
<option value="<?= $k['id_kategori'] ?>"><?= $k['nama_kategori'] ?></option>
<?php } ?>
</select>

<input type="file" name="gambar" class="form-control mb-3">

<button name="simpan" class="btn btn-primary">Simpan</button>

</form>
</div>

</div>