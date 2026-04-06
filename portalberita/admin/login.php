<?php
session_start();

// generate captcha
$captcha = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, 5);
$_SESSION['captcha'] = $captcha;

$error = isset($_GET['error']) ? $_GET['error'] : "";
?>

<!DOCTYPE html>
<html>
<head>
<title>Login Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
    height: 100vh;
    background: linear-gradient(135deg, #4e54c8, #8f94fb);
    display: flex;
    justify-content: center;
    align-items: center;
}

.card {
    border-radius: 15px;
}

.captcha-box {
    font-weight: bold;
    font-size: 20px;
    letter-spacing: 3px;
    background: #eee;
    padding: 10px;
    text-align: center;
    border-radius: 10px;
}
</style>
</head>

<body>

<div class="card shadow-lg p-4" style="width:350px">

<div class="text-center mb-3">
    <i class="bi bi-person-circle" style="font-size:50px;"></i>
    <h4>Login Admin</h4>
</div>

<?php if($error){ ?>
<div class="alert alert-danger"><?= $error ?></div>
<?php } ?>

<form method="POST" action="proses_login.php">

<input type="text" name="username" class="form-control mb-2" placeholder="Username" required>
<input type="password" name="password" class="form-control mb-2" placeholder="Password" required>

<!-- CAPTCHA -->
<div class="captcha-box mb-2">
    <?= $captcha ?>
</div>

<input type="text" name="captcha" class="form-control mb-3" placeholder="Masukkan captcha" required>

<button class="btn btn-primary w-100" name="login">
    <i class="bi bi-box-arrow-in-right"></i> Login
</button>

</form>

</div>

</body>
</html>