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
</head>
<body>
    <!-- Header -->
    <header class="container mx-auto flex justify-between items-center fixed top-0 left-0 right-0" style="background-color: #8ACEF1; height: 80px; width: 100%; z-index: 1000;">
        <div class="flex items-center">
            <img alt="Logo HalalTrust" style="margin-left: 64px;" width="48" height="48" src="assets/landing_page/logo_halaltrust_land.svg"/>
            <span style="font-family: 'Acme', sans-serif; font-size: 32px; color: #0F52BA; margin-left: 16px;">HalalTrust</span>
        </div>
        <nav class="flex space-x-8 items-center" style="position: absolute; left: 50%; transform: translateX(-50%);">
            <a class="hover:underline flex items-center" href="#" style="color: #0F52BA;">
                <img src="assets/landing_page/home_land.svg" alt="Home" width="24" height="24" style="margin-right: 16px;"/>Home
            </a>
            <a class="hover:underline flex items-center" href="#info_tanya" style="color: #0F52BA;">
                <img src="assets/landing_page/kirim_pertanyaan_land.svg" alt="Kirim Pertanyaan" width="24" height="24" style="margin-right: 16px;"/>Kirim Pertanyaan
            </a>
            <a class="hover:underline flex items-center" href="#info_cek_produk" style="color: #0F52BA;">
                <img src="assets/landing_page/cek_produk_land.svg" alt="Cek Produk" width="24" height="24" style="margin-right: 16px;"/>Cek Produk
            </a>
            <a class="hover:underline flex items-center" href="#info_tentang_kami" style="color: #0F52BA;">
                <img src="assets/landing_page/tentang_kami_land.svg" alt="Tentang Kami" width="24" height="24" style="margin-right: 16px;"/>Tentang Kami
            </a>
        </nav>   
        <a class="flex items-center justify-center text-white self-center btn-hover" style="width: 104px; height: 40px; background-color: #008ECC; margin-right: 64px; padding: 0; border-radius: 4px;" href="user/dashboard.php">
            <span style="margin-right: 12px;">Masuk</span>
            <img alt="Ikon User" src="assets/landing_page/ikon_user_land.svg" width="24" height="24"/>
        </a>
    </header>
    <div style="height: 80px;"></div>

    <!-- Pembuka -->
    <section class="bg-cover bg-center text-center text-white flex flex-col justify-center" style="height: 272px; background-image: url('assets/landing_page/bg_pembuka_land.jpg');">
        <img src="assets/landing_page/bismillah_land.svg" alt="Bismillah" class="mx-auto" width="464"/>
        <p class="mx-auto"style="margin-top: 24px; margin-bottom: 24px; max-width: 800px; line-height: 1.5; text-align: center;">
            Assalamualaikum, selamat datang di website kami!<br/>
            Temukan kehalalan produk dan layanan dengan mudah dan cepat di platform terpercaya kami.
        </p>
        <a class="flex items-center justify-center text-white self-center btn-hover" style="width: 224px; height: 40px; background-color: #008ECC; padding: 0; border-radius: 4px;" href="register.php">Bergabung Dengan Kami</a>
    </section>

    <!-- Konten Utama -->
    <main>
        <!-- Info Tanya -->
        <section id="info_tanya" class="flex items-center" style="height: 702px; padding-top: 30px;">
            <img alt="Ikon Tanya" style="margin-left: 62px;" src="assets/landing_page/ikon_tanya_land.svg" width="562"/>
            <div style="margin-left: 100px;">
                <h2 style="font-size: 26px;">Kirim Pertanyaan</h2>
                <p class="mx-auto" style="margin-top: 20px; margin-bottom: 20px; max-width: 630px; line-height: 1.5; text-align: justify; overflow-wrap: break-word;">Punya pertanyaan tentang kehalalan produk, bahan, atau aktivitas? Gunakan fitur Kirim Pertanyaan Halal & Haram untuk mendapatkan jawaban yang tepat. Ajukan pertanyaan Anda, dan kami akan memberikan penjelasan yang terpercaya dan sesuai dengan prinsip Islam!</p>
                <div class="flex justify-center">
                    <a class="flex items-center justify-center text-white btn-hover" 
                    style="width: 160px; height: 40px; background-color: #008ECC; padding: 0; border-radius: 4px; margin-left: auto; margin-right: auto;" 
                    href="user/kirim_pertanyaan/dash_kirim_pertanyaan.php">Kirim Pertanyaan</a>
                </div>
            </div>
        </section>

        <!-- Info Cek Produk -->
        <section id="info_cek_produk" class="bg-[#FAF0E6] container mx-auto py-8">
            <div class="flex items-center" style="height: 672px;">
                <div style="margin-right: 100px; margin-left: 166px;">
                    <h2 style="font-size: 26px;">Cek Produk</h2>
                    <p class="mx-auto" style="margin-top: 20px; margin-bottom: 20px; max-width: 630px; line-height: 1.5; text-align: justify; overflow-wrap: break-word;">Gunakan fitur Cek Produk untuk mengetahui kehalalan produk anda. Fitur ini memberikan informasi akurat mengenai status kehalalan produk yang anda miliki. Masukkan komposisi produk anda, dan pastikan semuanya sesuai dengan prinsip Islam!</p>
                    <div class="flex justify-center">
                        <a class="flex items-center justify-center text-white btn-hover" 
                        style="width: 242px; height: 40px; background-color: #008ECC; padding: 0; border-radius: 4px; margin-left: auto; margin-right: auto;" 
                        href="user/cek_produk/dash_cek_produk.php">Cek Produk Anda Sekarang</a>
                    </div>
                </div>
                <img alt="Ikon Halal" style="margin-right: 62px;" src="assets/landing_page/ikon_halal_land.svg" width="562"/>
            </div>
        </section >

        <!-- Info Tentang Kami -->
        <section id="info_tentang_kami" class="flex items-center" style="height: 702px; padding-top: 30px;">
            <img alt="Ikon Info" style="margin-left: 62px;" src="assets/landing_page/ikon_info_land.svg" width="560"/>
            <div style="margin-left: 100px;">
                <h2 style="font-size: 26px;">Tentang Kami</h2>
                <p class="mx-auto" style="margin-top: 20px; margin-bottom: 20px; max-width: 630px; line-height: 1.5; text-align: justify; overflow-wrap: break-word;">Selamat datang di HalalTrust – platform pengecekan status halal dan haram yang bertujuan memberikan informasi akurat dan terpercaya kepada masyarakat. Kami hadir dengan misi untuk memudahkan masyarakat dalam memastikan kehalalan produk-produk yang mereka konsumsi atau gunakan dalam kehidupan sehari-hari.</p>
                <div class="flex justify-center">
                    <a class="flex items-center justify-center text-white btn-hover" 
                    style="width: 160px; height: 40px; background-color: #008ECC; padding: 0; border-radius: 4px; margin-left: auto; margin-right: auto;" 
                    href="#">Baca Selanjutnya</a>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="container mx-auto flex items-center py-4 px-6" style="background-color: #8ACEF1; height: 256px; width: 100%;">
        <div class="flex items-center w-full">
            <div class="flex items-center">
                <img alt="Logo HalalTrust" style="margin-left: 40px;" width="160" height="160" src="assets/landing_page/logo_halaltrust_land.svg"/>
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
                            <img src="assets/landing_page/telfon_land.svg" alt="Ikon Telepon" class="inline-block mr-2" width="24"/>
                            021-xxxxxxxx
                        </li>
                        <li>
                            <img src="assets/landing_page/email_land.svg" alt="Ikon Email" class="inline-block mr-2" width="24"/>
                            Kelompok6@gmail.com
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>