<?php
session_start();

// hapus semua session
$_SESSION = [];
session_unset();
session_destroy();

// redirect (sesuaikan path!)
header("Location: ../logout.php");
exit;