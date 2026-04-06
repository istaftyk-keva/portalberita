<?php
include __DIR__ . '/../config/koneksi.php';
include __DIR__ . '/../layout/header.php';
// validasi id
if(!isset($_GET['id']) || empty($_GET['id'])){
    die("ID tidak ditemukan!");
}

$id = intval($_GET['id']);

// update views
$stmt = $conn->prepare("UPDATE artikel SET views = views + 1 WHERE id_artikel = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

// ambil data artikel
$stmt = $conn->prepare("SELECT * FROM artikel WHERE id_artikel = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 0){
    die("Artikel tidak ditemukan!");
}

$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title><?= $data['judul'] ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">

<h2><?= $data['judul'] ?></h2>

<p class="text-muted">
    📅 <?= $data['tanggal'] ?> | 👁️ <?= $data['views'] ?>x
</p>

<?php if(!empty($data['gambar'])){ ?>
    <img src="upload/<?= $data['gambar'] ?>" class="img-fluid rounded mb-3">
<?php } ?>

<p><?= nl2br($data['isi']) ?></p>

<a href="index.php" class="btn btn-secondary mt-3">← Kembali</a>

</div>

</body>
</html>