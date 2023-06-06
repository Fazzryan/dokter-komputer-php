<?php
session_start();
include "db/koneksi.php";
include "fungsi.php";

$user = !empty($_SESSION["id_user"]) ? $user = $_SESSION["id_user"] : $user = "";
// Pagination
$batas_halaman = 16;
$halaman = isset($_GET["halaman"]) ? (int) $_GET["halaman"] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas_halaman) - $batas_halaman : 0;

$sebelumnya = $halaman - 1;
$selanjutnya = $halaman + 1;
$data_produk = mysqli_query($koneksi, "SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori = kategori.id_kategori");

$jumlah_data = mysqli_num_rows($data_produk);
$total_halaman = ceil($jumlah_data / $batas_halaman);
$nomor = $halaman_awal + 1;

$produk = show("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori = kategori.id_kategori ORDER BY id_produk DESC LIMIT $halaman_awal, $batas_halaman");

$jumlah_produk = show("SELECT COUNT(*) AS jml_produk FROM produk");
// var_dump($jumlah_produk);
// die;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/css/bootstrap.css">
    <link rel="stylesheet" href="asset/css/style.css">
    <!-- Bs Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Tentang Kami - Dokter Komputer</title>
</head>

<body>

    <?php include "navbar.php" ?>

    <section id="hero">
        <div class="container">
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tentang Kami</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <section class="mb-5">
        <div class="container">
            <div class="row ">
                <div class="col-12 col-lg-6 ">
                    <h3 class="mb-4">Tentang Kami</h3>
                    <p>Dokter komputer merupakan e-commerce yang dibuat oleh kelompok 5 untuk memenuhi salah satu tugas mata kuliah Rekayasa Perangkat Lunak (RPL). Aplikasi ini menyediakan berbagai macam komponen komputer/laptop yang mungkin anda sedang cari.</p>

                    <p>Selain itu aplikasi ini juga menyediakan jasa service laptop/komputer yang bermasalah, bisa langsung kami perbaiki. Dan juga kami menyediakan fitur chat untuk konsumen kalau misalnya mau bertanya.</p>
                </div>
                <div class="col-12 col-lg-6">
                    <h3 class="mb-2">Kontak Kami</h3>
                    <p>Jika ada pertanyaan lebih lanjut bisa mengisi form dibawah ini.</p>
                    <div class="row row-cols-1 row-cols-md-2 g-2">
                        <div class="mb-2 mb-lg-3">
                            <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" required autocomplete="off">
                        </div>
                        <div class="mb-2 mb-lg-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" required autocomplete="off">
                        </div>
                    </div>
                    <div class="row row-cols-1">
                        <div class="col">
                            <label for="pesan" class="form-label">Pesan</label>
                            <textarea name="" id="" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="col mt-2">
                            <button class="btn btn-green">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-2 g-md-3 row-cols-md-1 row-cols-lg-2 row-cols-xl-3 my-5">
                <div class="col">
                    <h3 class="mb-4">Profile Pembuat</h3>
                    <div class="py-4 rounded-16 shadow-1">
                        <div class="d-flex flex-row justify-content-xl-between px-3">
                            <img src="asset/img/profile1.jpg" alt="profile" class="rounded-3" width="135">
                            <div class="ms-3">
                                <div class="d-flex flex-column justify-content-between h-100">
                                    <div>
                                        <h5 class="">Dinda Fazryan</h5>
                                        <span class="fs-13 text-gray">Web Developer</span>
                                        <span class="d-block mt-1 fs-14">Lorem ipsum dolor sit amet consectetur adipisicing Lorem.</span>
                                    </div>
                                    <div class="d-flex">
                                        <span class="me-2">
                                            <a href="#"><i class="bi bi-instagram"></i></a>
                                        </span>
                                        <span class="me-2">
                                            <a href="#"><i class="bi bi-youtube"></i></a>
                                        </span>
                                        <span class="me-2">
                                            <a href="#"><i class="bi bi-facebook"></i></a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <?php include "footer.php" ?>

    <script src="asset/js/bootstrap.js"></script>
    <script src="asset/js/script.js"></script>
</body>

</html>