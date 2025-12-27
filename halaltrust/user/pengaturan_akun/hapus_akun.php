<?php
session_start();
include('../../connection/connection.php');

if (!isset($_SESSION['email'])) {
    header("Location: ../../login.php");
    exit();
}

$email = $_SESSION['email'];

$sql = "DELETE FROM user WHERE email = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s", $email);

if ($stmt->execute()) {
    // Logout user after account deletion
    session_destroy();
    header("Location: ../../login.php?message=account_deleted");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$connection->close();
?>