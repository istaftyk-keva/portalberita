<?php
include '../config/koneksi.php';

// ambil data dari form
$nama = $_POST['nama_kategori'];

// =======================
// UPLOAD GAMBAR
// =======================
$gambar = $_FILES['gambar']['name'];
$tmp    = $_FILES['gambar']['tmp_name'];

$folder = "../uploads/kategori/";

// bikin nama unik
$nama_file = time() . "_" . basename($gambar);

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
    INSERT INTO kategori (nama_kategori, gambar) 
    VALUES (?, ?)
");

$query->bind_param("ss", $nama, $nama_file);

if ($query->execute()) {
    echo "<script>alert('Kategori berhasil ditambahkan');window.location='kategori.php';</script>";
} else {
    echo "Gagal menyimpan data!";
}