<?php
session_start();
include 'connection/connection.php';

$error = '';
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']); // Hapus error setelah ditampilkan
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Proses login
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        // Cek di tabel 'user' terlebih dahulu
        $queryUser = "SELECT * FROM `user` WHERE email = ?";
        $stmtUser = mysqli_prepare($connection, $queryUser);
        mysqli_stmt_bind_param($stmtUser, "s", $email);
        mysqli_stmt_execute($stmtUser);
        $resultUser = mysqli_stmt_get_result($stmtUser);

        if ($resultUser && mysqli_num_rows($resultUser) > 0) {
            $user = mysqli_fetch_assoc($resultUser);

            if ($password === $user['password']) {
                // Login berhasil sebagai user
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                header("Location: user/dashboard.php");
                exit();
            } else {
                $_SESSION['error'] = "Password salah!";
            }
        } else {
            // Jika tidak ditemukan di tabel 'user', cek di tabel 'admin'
            $queryAdmin = "SELECT * FROM `admin` WHERE email = ?";
            $stmtAdmin = mysqli_prepare($connection, $queryAdmin);
            mysqli_stmt_bind_param($stmtAdmin, "s", $email);
            mysqli_stmt_execute($stmtAdmin);
            $resultAdmin = mysqli_stmt_get_result($stmtAdmin);

            if ($resultAdmin && mysqli_num_rows($resultAdmin) > 0) {
                $admin = mysqli_fetch_assoc($resultAdmin);

                if ($password === $admin['password']) {
                    // Login berhasil sebagai admin
                    $_SESSION['admin_id'] = $admin['admin_id'];
                    $_SESSION['username'] = $admin['username'];
                    $_SESSION['email'] = $admin['email'];
                    header("Location: admin/dashboard.php");
                    exit();
                } else {
                    $_SESSION['error'] = "Password salah!";
                }
            } else {
                $_SESSION['error'] = "Email tidak ditemukan!";
            }
        }
    } else {
        $_SESSION['error'] = "Silakan isi email dan password!";
    }

    // Redirect untuk mencegah form resubmission dan error tetap ada
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HalalTrust</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <style>
        body {
            background-image: url('assets/login/bg_log.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
        }
        .btn-hover {
            transition: box-shadow 0.3s ease;
        }
        .btn-hover:hover {
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.25);
        }
        input::placeholder {
            color: #CCCCCC;
        }
        input:focus {
            border-color: #0F52BA;
            outline: none;
        }
        .border-separator {
            border-right-width: 2px;
            border-color: #CCCCCC;
        }
        .close-button:hover img {
            filter: brightness(0) saturate(100%) invert(28%) sepia(91%) saturate(4796%) hue-rotate(350deg) brightness(92%) contrast(105%);
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg w-full max-w-3xl" style="border-radius: 4px;">
        <!-- Header -->
        <div class="bg-[#F6F6F6] flex justify-between items-center" style="border-radius: 4px 4px 0 0; padding: 16px; height: 46px;">
            <h2 style="color: #0F52BA; margin-left: 14px;">Masuk</h2>
            <a href="index.php" class="close-button">
                <img src="assets/login/x_log.svg" alt="Close Icon" width="26" height="26">
            </a>
        </div>

        <!-- Konten Utama -->
        <div class="p-8">
            <div class="flex justify-center items-start">
                <!-- Masuk -->
                <div class="w-1/2 pr-4 border-separator">
                    <form method="POST" action="login.php">
                        <div class="mb-4 relative">
                            <input class="w-full px-10 py-2 border-2 rounded" type="email" id="email" name="email" placeholder="Email" style="border-color: #0F52BA;">
                            <img src="assets/login/email_log.svg" alt="Email Icon" class="absolute left-3 top-2.5 w-5 h-5">
                        </div>
                        <div class="mb-4 relative">
                            <input class="w-full px-10 py-2 border-2 rounded" type="password" id="password" name="password" placeholder="Password" style="border-color: #0F52BA;">
                            <img src="assets/login/kunci_log.svg" alt="Password Icon" class="absolute left-3 top-2.5 w-5 h-5">
                            <button type="button" onclick="togglePassword()" class="absolute right-3 top-2.5">
                                <img src="assets/login/mata_log.svg" alt="Show Password Icon" id="toggleIcon" class="w-5 h-5">
                            </button>
                        </div>
                        <button type="submit" class="w-full text-white py-2 btn-hover" style="background-color: #0F52BA; border-radius: 4px;">Masuk</button>
                        <?php if (!empty($error)): ?>
                            <p class="mt-2" style="color: #D1001F;"><?php echo $error; ?></p>
                        <?php endif; ?>
                    </form>
                    <p class="mt-4 text-center">
                        Tidak bisa masuk ke akun Anda?<br>
                        <a href="forgot_password.php" class="hover:underline" style="color: #0F52BA;">Lupa password</a>
                    </p>
                </div>
                <script>
                    function togglePassword() {
                        const passwordField = document.getElementById('password');
                        const toggleIcon = document.getElementById('toggleIcon');
                        if (passwordField.type === 'password') {
                            passwordField.type = 'text';
                            toggleIcon.src = 'assets/login/mata_sembunyi_log.svg';
                        } else {
                            passwordField.type = 'password';
                            toggleIcon.src = 'assets/login/mata_log.svg';
                        }
                    }
                </script>

                <!-- Daftar -->
                <div class="w-1/2 pl-4 flex flex-col items-center justify-center mt-10">
                    <p class="mb-4">Tidak punya akun?</p>
                    <a class="w-full text-white py-2 btn-hover flex items-center justify-center" style="background-color: #0F52BA; border-radius: 4px;" href="register.php">Daftar</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>