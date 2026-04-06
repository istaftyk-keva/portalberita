CREATE DATABASE portal_berita;
USE portal_berita;

-- TABEL ADMIN
CREATE TABLE admin (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100),
    password VARCHAR(255)
);

-- PASSWORD: admin123 (sudah di-hash)
INSERT INTO admin (username, password) VALUES 
('admin', '$2y$10$wH9z8jZJ8jXgZqXK1zF7sOjV1Q7Yyq9X7F9q2kKq2QXcP6eKXzG9W');

-- TABEL KATEGORI
CREATE TABLE kategori (
    id_kategori INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100)
);

-- TABEL ARTIKEL
CREATE TABLE artikel (
    id_artikel INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255),
    isi TEXT,
    gambar VARCHAR(255),
    id_kategori INT,
    tanggal DATETIME DEFAULT CURRENT_TIMESTAMP,
    views INT DEFAULT 0,
    FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori) ON DELETE SET NULL
);