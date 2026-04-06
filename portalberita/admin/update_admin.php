<?php
include '../config/koneksi.php';

$id   = (int)$_POST['id'];
$user = $_POST['username'];
$pass = $_POST['password'];

if(!empty($pass)){
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE admin SET username=?, password=? WHERE id_admin=?");
    $stmt->bind_param("ssi", $user, $hash, $id);
} else {
    $stmt = $conn->prepare("UPDATE admin SET username=? WHERE id_admin=?");
    $stmt->bind_param("si", $user, $id);
}

$stmt->execute();

header("Location: admin.php");