<?php
include '../config/koneksi.php';

$id = $_GET['id'];

// ambil gambar dulu (biar bisa dihapus dari folder)
$stmt = $conn->prepare("SELECT gambar FROM artikel WHERE id_artikel=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

if($data){
    $file = "../uploads/" . $data['gambar'];

    // hapus file jika ada
    if(file_exists($file)){
        unlink($file);
    }
}

// hapus dari database
$stmt = $conn->prepare("DELETE FROM artikel WHERE id_artikel=?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: artikel.php");