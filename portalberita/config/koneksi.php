<?php
$conn = new mysqli("localhost", "root", "", "portal_berita");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>