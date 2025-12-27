<?php
session_start();

// Hapus semua sesi
session_unset();
session_destroy();

// Arahkan ke landing_page.php
header("Location: index.php");
exit();
?>
