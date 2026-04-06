<?php
include '../config/koneksi.php';

// ambil data dari form
$judul   = $_POST['judul'];
$isi     = $_POST['isi'];
$tanggal = date('Y-m-d');
$views   = 0;

// =======================
// UPLOAD GAMBAR
// =======================
$gambar = $_FILES['gambar']['name'];
$tmp    = $_FILES['gambar']['tmp_name'];

$folder = "../uploads/";

// kasih nama unik biar tidak ketimpa
$nama_file = time() . "_" . basename($gambar);

// validasi upload
if (!empty($gambar)) {

    $ext = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'webp'];

    if (in_array($ext, $allowed)) {

        move_uploaded_file($tmp, $folder . $nama_file);

    } else {
        echo "<script>alert('Format gambar tidak valid!');history.back();</script>";
        exit;
    }

} else {
    $nama_file = null;
}

// =======================
// SIMPAN KE DATABASE
// =======================
$query = $conn->prepare("
    INSERT INTO artikel (judul, isi, gambar, tanggal, views) 
    VALUES (?, ?, ?, ?, ?)
");

$query->bind_param("ssssi", $judul, $isi, $nama_file, $tanggal, $views);

if ($query->execute()) {
    echo "<script>alert('Artikel berhasil ditambahkan');window.location='artikel.php';</script>";
} else {
    echo "Gagal menyimpan data!";
}