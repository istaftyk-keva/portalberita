<?php
include '../config/koneksi.php';

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM kategori WHERE id_kategori=?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: kategori.php");