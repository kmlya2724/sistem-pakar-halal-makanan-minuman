<?php
session_start();
include('../../connection/connection.php');

if (!isset($_SESSION['email'])) {
    header("Location: ../../login.php");
    exit;
}

$status = ''; // Variabel untuk menyimpan status
$pertanyaanTersimpan = ''; // Variabel untuk menyimpan pertanyaan jika gagal

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_SESSION['email'];
    $pertanyaan = mysqli_real_escape_string($connection, $_POST['pertanyaan']);
    
    // Simpan pertanyaan dalam variabel jika terjadi kegagalan
    $pertanyaanTersimpan = htmlspecialchars($pertanyaan);

    // Masukkan data ke tabel pertanyaan_user
    $query = "INSERT INTO pertanyaan_user (email, pertanyaan) VALUES ('$email', '$pertanyaan')";
    if (mysqli_query($connection, $query)) {
        $status = 'success';
    } else {
        $status = 'fail';
    }
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
        // Fungsi untuk menampilkan hasil pengiriman
        function showResult(status) {
            const container = document.getElementById('pertanyaanContainer');
            const pertanyaanText = document.getElementById('pertanyaan').value;

            if (status === 'success') {
                container.innerHTML = `
                    <div class="flex justify-center items-center mb-4 mt-12">
                        <img src="../../assets/dashboard/ceklis_dash.svg" alt="Ikon Ceklis" class="w-24 h-24">
                    </div>
                    <p class="text-center mb-4">Pertanyaan anda berhasil terkirim</p>
                    <div class="flex justify-center">
                        <button id="resetButton" class="mt-4 text-white py-2 px-6 btn-hover" style="background-color: #0F52BA; border-radius: 4px;" onclick="resetForm()">OK</button>
                    </div>
                `;
            } else if (status === 'fail') {
                container.innerHTML = `
                    <div class="flex justify-center items-center mb-4 mt-12">
                        <img src="../../assets/dashboard/x_dash.svg" alt="Ikon Silang" class="w-24 h-24">
                    </div>
                    <p class="text-center mb-4">Pertanyaan anda gagal terkirim, coba beberapa saat lagi.</p>
                    <div class="flex justify-center">
                        <button id="resetButton" class="mt-4 text-white py-2 px-6 btn-hover" style="background-color: #0F52BA; border-radius: 4px;" onclick="resetForm('${pertanyaanText}')">Kembali</button>
                    </div>
                `;
            }
        }

        // Fungsi untuk mereset formulir
        function resetForm(savedQuestion = '') {
            const container = document.getElementById('pertanyaanContainer');
            container.innerHTML = `
                <form method="POST" action="">
                    <label for="pertanyaan" style="position: relative; margin-bottom: 14px; margin-left: 1px; display: inline-block;">Pertanyaan</label>
                    <textarea id="pertanyaan" name="pertanyaan"
                            style="resize: none; background-color: #B4E4FB; border: 4px solid #D9D9D9; border-radius: 4px; height: 226px; width: calc(100% - 4px); margin: 0 auto; display: block; box-sizing: border-box;">${savedQuestion}</textarea>
                    <div class="flex justify-center mt-4">
                        <button type="submit" id="kirimPertanyaanButton" class="text-white p-2 px-6 btn-hover" style="background-color: #0F52BA; border-radius: 4px;">Kirim</button>
                    </div>
                </form>
            `;
        }

        // Jalankan saat halaman dimuat berdasarkan status PHP
        document.addEventListener('DOMContentLoaded', function () {
            const status = '<?php echo $status; ?>';
            if (status) {
                showResult(status);
            }
        });
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
                <a href="#" class="flex items-center p-4 border-b-4 border-[#999999] bg-[#B4E4FB]" style="height: 52px;">
                    <img src="../../assets/dashboard/kirim_pertanyaan_dash.svg" alt="Ikon Kirim Pertanyaan" width="24"/>
                    <span class="ml-4 text-lg">Kirim Pertanyaan</span>
                    <img src="../../assets/dashboard/chevron_dash.svg" alt="Ikon Chevron" class="ml-auto" width="16"/>
                </a>
                <a href="../detail_pribadi/dash_detail_pribadi.php" class="flex items-center p-4 border-b-4 border-[#999999] hover:bg-[#B4E4FB] focus:bg-[#B4E4FB]" style="height: 52px;">
                    <img src="../../assets/dashboard/detail_pribadi_dash.svg" alt="Ikon Detail Pribadi" width="24"/>
                    <span class="ml-4 text-lg">Detail Pribadi</span>
                    <img src="../../assets/dashboard/chevron_dash.svg" alt="Ikon Chevron" class="ml-auto" width="16"/>
                </a>
                <a href="../pengaturan_akun/dash_pengaturan_akun.php" class="flex items-center p-4 hover:bg-[#B4E4FB] focus:bg-[#B4E4FB]" style="width: px; height: 44px;">
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
                <p>Kirim Pertanyaan</p>
            </div>
            <hr style="border: none; border-top: 4px solid #0F52BA; margin: 17px 0;">
            <div id="pertanyaanContainer" class="bg-white p-8 shadow-md" style="border-radius: 4px; margin-top: -10px; width: 820px; height: 352px; padding: 16px;">
                <!-- Konten formulir akan diubah berdasarkan status -->
                <form method="POST" action="">
                    <label for="pertanyaan" style="position: relative; margin-bottom: 14px; margin-left: 1px; display: inline-block;">Pertanyaan</label>
                    <textarea id="pertanyaan" name="pertanyaan"
                            style="resize: none; background-color: #B4E4FB; border: 4px solid #D9D9D9; border-radius: 4px; height: 226px; width: calc(100% - 4px); margin: 0 auto; display: block; box-sizing: border-box;"><?php echo $pertanyaanTersimpan; ?></textarea>
                    <div class="flex justify-center mt-4">
                        <button type="submit" id="kirimPertanyaanButton" class="text-white p-2 px-6 btn-hover" style="background-color: #0F52BA; border-radius: 4px;">Kirim</button>
                    </div>
                </form>
            </div>
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