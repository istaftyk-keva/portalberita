<?php
session_start();
include __DIR__ . '/../config/koneksi.php';

if(isset($_POST['login'])){

    $user = trim($_POST['username']);
    $pass = trim($_POST['password']);
    $captcha = $_POST['captcha'];

    // ======================
    // CEK CAPTCHA
    // ======================
    if($captcha != $_SESSION['captcha']){
        header("Location: ../login.php?error=Captcha salah!");
        exit;
    }

    // ======================
    // CEK USER
    // ======================
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username=?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){

        $data = $result->fetch_assoc();

        // ======================
        // CEK PASSWORD
        // ======================
        if(password_verify($pass, $data['password'])){

            $_SESSION['admin'] = $data['username'];

            // 🔥 FIX PATH
            header("Location: ../admin/dashboard.php");
            exit;

        } else {
            header("Location: ../login.php?error=Password salah!");
            exit;
        }

    } else {
        header("Location: ../login.php?error=Username tidak ditemukan!");
        exit;
    }
}
?>