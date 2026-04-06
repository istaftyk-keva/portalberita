<?php
include '../config/koneksi.php';

$user = $_POST['username'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $user, $pass);

if($stmt->execute()){
    header("Location: admin.php");
} else {
    echo "Gagal menyimpan";
}