<?php
session_start();
include('../../connection/connection.php');

if (!isset($_SESSION['email'])) {
    header("Location: ../../login.php");
    exit();
}

// Ambil username dari database
$email = $_SESSION['email'];
$sql = "SELECT username FROM user WHERE email = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
} else {
    $username = "User"; // Default jika username tidak ditemukan
}

$stmt->close();
$connection->close();

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HalalTrust</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            overflow: ;
        }
        html {
                scroll-behavior: smooth;
        }
        .btn-hover {
            transition: box-shadow 0.3s ease;
        }

        .btn-hover:hover {
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.25);
        }
    </style>
    <script>
        function togglePassword(button) {
            // Dapatkan input password field yang terkait dengan tombol yang ditekan
            const passwordField = button.parentElement.querySelector('.password-field');
            // Dapatkan ikon toggle yang terkait
            const toggleIcon = button.querySelector('.toggle-icon');

            // Ubah tipe input dan ikon berdasarkan kondisinya
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.src = '../../assets/login/mata_sembunyi_log.svg';
            } else {
                passwordField.type = 'password';
                toggleIcon.src = '../../assets/login/mata_log.svg';
            }
        }
    </script>

</head>
<body>
    <!-- Header -->
    <header class="container mx-auto flex justify-between items-center" style="background-color: #8ACEF1; height: 80px; width: 100%; z-index: 1000;">
        <div class="flex items-center">
            <a href="../dashboard.php" style="display: flex; align-items: center; text-decoration: none;">
                <img alt="Logo HalalTrust" style="margin-left: 64px;" width="48" height="48" src="../../assets/landing_page/logo_halaltrust_land.svg"/>
                <span style="font-family: 'Acme', sans-serif; font-size: 32px; color: #0F52BA; margin-left: 16px;">HalalTrust</span>
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <div class="flex p-8">
        <!-- Sidebar -->
        <div style="margin-left: 20px; margin-top: 20px;">
            <div class="flex items-center mb-4">
                <img src="../../assets/dashboard/ikon_user_dash.svg" alt="Ikon User" width="48"/>
                <h2 style="font-size: 26px; color: #0F52BA; margin-left: 18px;"><?php echo htmlspecialchars($username); ?></h2>
            </div>
            <div class="shadow-md bg-[#D9D9D9]" style="border-radius: 4px; width: 588px;">
                <a href="../cek_produk/dash_cek_produk.php" class="flex items-center p-4 border-b-4 border-[#999999] hover:bg-[#B4E4FB] focus:bg-[#B4E4FB]" style=" border-top: 4px solid #0F52BA; height: 52px;">
                    <img src="../../assets/dashboard/cek_produk_dash.svg" alt="Ikon Cek Produk" width="24"/>
                    <span class="ml-4 text-lg">Cek Produk</span>
                    <img src="../../assets/dashboard/chevron_dash.svg" alt="Ikon Chevron" class="ml-auto" width="16"/>
                </a>
                <a href="../kirim_pertanyaan/dash_kirim_pertanyaan.php" class="flex items-center p-4 border-b-4 border-[#999999] hover:bg-[#B4E4FB] focus:bg-[#B4E4FB]" style="height: 52px;">
                    <img src="../../assets/dashboard/kirim_pertanyaan_dash.svg" alt="Ikon Kirim Pertanyaan" width="24"/>
                    <span class="ml-4 text-lg">Kirim Pertanyaan</span>
                    <img src="../../assets/dashboard/chevron_dash.svg" alt="Ikon Chevron" class="ml-auto" width="16"/>
                </a>
                <a href="../detail_pribadi/dash_detail_pribadi.php" class="flex items-center p-4 border-b-4 border-[#999999] hover:bg-[#B4E4FB] focus:bg-[#B4E4FB]" style="height: 52px;">
                    <img src="../../assets/dashboard/detail_pribadi_dash.svg" alt="Ikon Detail Pribadi" width="24"/>
                    <span class="ml-4 text-lg">Detail Pribadi</span>
                    <img src="../../assets/dashboard/chevron_dash.svg" alt="Ikon Chevron" class="ml-auto" width="16"/>
                </a>
                <a href="#" class="flex items-center p-4 bg-[#B4E4FB]" style="width: px; height: 44px;">
                    <img src="../../assets/dashboard/pengaturan_akun_dash.svg" alt="Ikon Pengaturan Akun" width="24"/>
                    <span class="ml-4 text-lg">Pengaturan Akun</span>
                    <img src="../../assets/dashboard/chevron_dash.svg" alt="Ikon Chevron" class="ml-auto" width="16"/>
                </a>
            </div>
            <button class="mt-4 text-white py-2 px-4 btn-hover" style="background-color: #D1001F; border-radius: 4px;" onclick="logout()">Keluar</button>
            <script>
                function logout() {
                    // Kirim permintaan logout ke logout.php
                    window.location.href = '../../logout.php';
                }
            </script>
        </div>

        <!-- Main Panel -->
        <div class="w-3/4" style="margin-right: 20px; margin-left: 24px;">
            <div class="text-center" style="font-size: 26px; color: #0F52BA; margin-top: 28px;">
                <p>Pengaturan Akun</p>
            </div>
            <hr style="border: none; border-top: 4px solid #0F52BA; margin: 17px 0;">
            <!-- Ubah Email -->
            <section class="bg-white rounded shadow mb-4" style="padding: 0; padding-bottom: 22px;">
                <div class="bg-[#F6F6F6] flex justify-between items-center" style="border-radius: 4px 4px 0 0; padding: 0 16px; height: 46px;">
                    <h2 style="color: #0F52BA; margin: 0;">Email</h2>
                </div>
                <div class="flex flex-col items-center mb-4" style="padding: 16px;">
                    <label for="email" style="margin-bottom: 8px;">Ubah email:</label>
                    <div class="flex items-center">
                        <div class="relative">
                            <input class="w-96 px-10 py-2 border-2 rounded" type="email" id="email" name="email" placeholder="Email" style="border-color: #0F52BA;">
                            <img src="../../assets/login/email_log.svg" alt="Email Icon" class="absolute left-3 top-2.5 w-5 h-5">
                        </div>
                        <a href="#" onclick="updateEmail()">
                            <img src="../../assets/dashboard/floppy_dash.svg" alt="Ikon Simpan" width="26" height="26" class="ml-4"> 
                        </a>
                    </div>
                </div>
                <hr style="border: none; border-top: 4px solid #0F52BA; margin: 16px 16px;">
                <div class="bg-white rounded shadow p-2 mt-4 flex items-center" style="margin: 0 16px;">
                    <span id="current-email" class="mr-2"><?= htmlspecialchars($_SESSION['email']); ?></span>
                    <img src="../../assets/dashboard/ceklis_dash.svg" alt="Ikon Ceklis" width="26" height="26" class="ml-2">
                </div>
            </section>

            <script>
                function updateEmail() {
                    const emailInput = document.getElementById('email');
                    const email = emailInput.value;

                    fetch('update_email.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'email=' + encodeURIComponent(email)
                    })
                    .then(response => response.text())
                    .then(data => {
                        if (data === 'success') {
                            document.getElementById('current-email').textContent = email;
                            alert('Email berhasil diperbarui');
                            emailInput.value = ''; // Mengosongkan field email setelah disimpan
                        } else {
                            alert('Gagal memperbarui email');
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }
            </script>

            <!-- Ubah Password -->
            <section class="bg-white rounded shadow mb-4" style="padding: 0; padding-bottom: 6px;">
                <div class="bg-[#F6F6F6] flex justify-between items-center" style="border-radius: 4px 4px 0 0; padding: 0 16px; height: 46px;">
                    <h2 style="color: #0F52BA; margin: 0;">Ubah Password</h2>
                </div>
                
                <!-- Memusatkan Konten -->
                <div class="flex flex-col items-center" style="padding: 16px;">
                    
                    <!-- Password Lama -->
                    <div class="w-96 mb-4">
                        <label for="old-password" style="display: block; text-align: left; margin-bottom: 8px; margin-top: 0px">Password Lama:</label>
                        <div class="relative">
                            <input id="old-password" class="w-full px-10 py-2 border-2 rounded password-field" type="password" placeholder="Password" style="border-color: #0F52BA;">
                            <img src="../../assets/login/kunci_log.svg" alt="Password Icon" class="absolute left-3 top-2.5 w-5 h-5">
                            <button type="button" onclick="togglePassword(this)" class="absolute right-3 top-2.5">
                                <img src="../../assets/login/mata_log.svg" alt="Show Password Icon" class="toggle-icon w-5 h-5">
                            </button>
                        </div>
                    </div>
                    
                    <!-- Password Baru -->
                    <div class="w-96 mb-4">
                        <label for="new-password" style="display: block; text-align: left; margin-bottom: 8px;">Password Baru:</label>
                        <div class="relative">
                            <input id="new-password" class="w-full px-10 py-2 border-2 rounded password-field" type="password" placeholder="Password" style="border-color: #0F52BA;">
                            <img src="../../assets/login/kunci_log.svg" alt="Password Icon" class="absolute left-3 top-2.5 w-5 h-5">
                            <button type="button" onclick="togglePassword(this)" class="absolute right-3 top-2.5">
                                <img src="../../assets/login/mata_log.svg" alt="Show Password Icon" class="toggle-icon w-5 h-5">
                            </button>
                        </div>
                    </div>
                    
                    <!-- Konfirmasi Password Baru -->
                    <div class="w-96 mb-4">
                        <label for="confirm-password" style="display: block; text-align: left; margin-bottom: 8px;">Konfirmasi Password Baru:</label>
                        <div class="relative">
                            <input id="confirm-password" class="w-full px-10 py-2 border-2 rounded password-field" type="password" placeholder="Password" style="border-color: #0F52BA;">
                            <img src="../../assets/login/kunci_log.svg" alt="Password Icon" class="absolute left-3 top-2.5 w-5 h-5">
                            <button type="button" onclick="togglePassword(this)" class="absolute right-3 top-2.5">
                                <img src="../../assets/login/mata_log.svg" alt="Show Password Icon" class="toggle-icon w-5 h-5">
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Tombol Simpan di Tengah -->
                <div class="flex justify-center">
                    <button class="bg-[#0F52BA] text-white py-2 px-4 btn-hover" style="margin: 0 16px 16px; border-radius: 4px;" onclick="updatePassword()">Simpan Perubahan</button>
                </div>
            </section>

            <script>
                function updatePassword() {
                    const oldPassword = document.getElementById('old-password').value;
                    const newPassword = document.getElementById('new-password').value;
                    const confirmPassword = document.getElementById('confirm-password').value;

                    fetch('update_password.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'old_password=' + encodeURIComponent(oldPassword) +
                            '&new_password=' + encodeURIComponent(newPassword) +
                            '&confirm_password=' + encodeURIComponent(confirmPassword)
                    })
                    .then(response => response.text())
                    .then(data => {
                        if (data === 'success') {
                            alert('Password berhasil diperbarui');
                            document.getElementById('old-password').value = '';
                            document.getElementById('new-password').value = '';
                            document.getElementById('confirm-password').value = '';
                        } else {
                            alert(data); // Menampilkan pesan kesalahan jika ada
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }
            </script>

            <section class="bg-white rounded shadow" style="padding: 0; padding-bottom: 6px;">
                <div class="bg-[#F6F6F6] flex justify-between items-center" style="border-radius: 4px 4px 0 0; padding: 0 16px; height: 46px;">
                    <h2 style="color: #0F52BA; margin: 0;">Hapus Akun Saya</h2>
                </div>
                <ol class="list-decimal list-inside text-sm mb-4" style="padding: 16px; font-size: 10px;">
                    <li>Setelah akun dihapus, Anda tidak akan dapat mengakses semua informasi yang terkait dengan akun Anda dan tidak dapat dikembalikan lagi.</li>
                    <li>Jika Anda memiliki pertanyaan yang tidak terselesaikan dalam akun, kami sarankan Anda menyelesaikan semua pertanyaan tersebut sebelum menutup akun Anda.</li>
                </ol>
                <div class="flex justify-center">
                    <form action="hapus_akun.php" method="POST">
                        <button type="submit" class="bg-[#D1001F] text-white py-2 px-4 btn-hover" style="margin: 0 16px 16px; border-radius: 4px;">Hapus Akun Saya</button>
                    </form>
                </div>

                <script>
                    document.querySelector("form").addEventListener("submit", function(e) {
                        if (!confirm("Apakah Anda yakin ingin menghapus akun Anda?")) {
                            e.preventDefault();
                        }
                    });
                </script>
            </section>
        </div>
    </div>

    <!-- Footer -->
    <footer class="container mx-auto flex items-center py-4 px-6" style="background-color: #8ACEF1; height: 256px; width: 100%;">
        <div class="flex items-center w-full">
            <div class="flex items-center">
                <img alt="Logo HalalTrust" style="margin-left: 40px;" width="160" height="160" src="../../assets/landing_page/logo_halaltrust_land.svg"/>
            </div>
            <div class="flex space-x-16" style="margin-left: 120px;">
                <div>
                    <h3 style="font-size: 26px; margin-bottom: 8px;">Tautan Penting</h3>
                    <hr style="border: none; border-bottom: 4px solid #0F52BA; width: 176%; margin-bottom: 12px;"/>
                    <ul class="space-y-2">
                        <li><a class="hover:underline" href="#">Syarat Penggunaan</a></li>
                        <li><a class="hover:underline" href="#">Kebijakan Privasi</a></li>
                        <li><a class="hover:underline" href="#">Kirim Masukan</a></li>
                    </ul>
                </div>
                <div style="margin-left: 274px;">
                    <h3 style="font-size: 26px; margin-bottom: 8px;">Kontak</h3>
                    <hr style="border: none; border-bottom: 4px solid #0F52BA; width: 160%; margin-bottom: 12px;"/>
                    <ul class="space-y-2">
                        <li>
                            <img src="../../assets/landing_page/telfon_land.svg" alt="Ikon Telepon" class="inline-block mr-2" width="24"/>
                            021-xxxxxxxx
                        </li>
                        <li>
                            <img src="../../assets/landing_page/email_land.svg" alt="Ikon Email" class="inline-block mr-2" width="24"/>
                            Kelompok6@gmail.com
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>