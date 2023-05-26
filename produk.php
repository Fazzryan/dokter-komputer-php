<?php
include "db/koneksi.php";
include "fungsi.php";

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
    <title>Dokter Komputer</title>
</head>

<body>

    <?php include "navbar.php" ?>

    <section id="hero">
        <div class="container">
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Produk</li>
                    </ol>
                </nav>
            </div>
            <div class="row mt-4">
                <div class="col-12 col-lg-3 d-none d-lg-block">
                    <h5>Kategori</h5>
                    <div class="card p-3 border-0 shadow-1 rounded-16 mb-4">
                        <div class="d-flex flex-column">
                            <div class="kategori-item">
                                <div class="me-2"><i class="bi bi-cart4"></i></div>
                                <a href="#">Semua Produk</a>
                            </div>
                            <div class="kategori-item">
                                <div class="me-2"><i class="bi bi-pc-display-horizontal"></i></div>
                                <a href="#">Komputer</a>
                            </div>
                            <div class="kategori-item">
                                <div class="me-2"><i class="bi bi-laptop"></i></div>
                                <a href="#">Laptop</a>
                            </div>
                            <div class="kategori-item">
                                <div class="me-2"><i class="bi bi-cpu"></i></div>
                                <a href="#">Prosesor</a>
                            </div>
                            <div class="kategori-item">
                                <div class="me-2"><i class="bi bi-speaker"></i></div>
                                <a href="#">Speaker</a>
                            </div>
                            <div class="kategori-item">
                                <div class="me-2"><i class="bi bi-headset"></i></div>
                                <a href="#">Headset</a>
                            </div>
                            <div class="kategori-item">
                                <div class="me-2"><i class="bi bi-hdd"></i></div>
                                <a href="#">Flashdisk</a>
                            </div>
                        </div>
                    </div>
                    <h5>Urut Berdasarkan</h5>
                    <div class="card p-3 border-0 shadow-1 rounded-16 mb-3">
                        <div class="kategori-item">
                            <div class="me-2"><i class="bi bi-bag-check"></i></div>
                            <a href="#">Produk Terbaru</a>
                        </div>
                        <div class="kategori-item">
                            <div class="me-2"><i class="bi bi-graph-down-arrow"></i></div>
                            <a href="#">Harga Tertinggi ke Terendah</a>
                        </div>
                        <div class="kategori-item">
                            <div class="me-2"><i class="bi bi-graph-up-arrow"></i></div>
                            <a href="#">Harga Terendah ke Tertinggi</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-9">
                    <div class="card mb-4 bg-light">
                        <div class="card-body p-4 ">
                            <h2 class="mb-0">Semua Produk</h2>
                        </div>
                    </div>

                    <div class="row row-cols-2 align-items-center">
                        <div class="col">
                            <h6><?= $jumlah_produk[0]["jml_produk"] ?> <span class="text-gray">Produk ditemukan</span></h6>
                        </div>
                        <div class="col">
                            <form action="" method="get" class="d-flex">
                                <input type="text" class="form-control me-1 me-md-2" name="cari_produk" id="cari_produk" placeholder="Cari produk">
                                <button type="submit" class="btn btn-green" style="border-radius: 8px;" name="btn_cari_produk"><i class="bi bi-search"></i></button>
                            </form>
                        </div>
                    </div>

                    <div class="row g-2 g-md-3 row-cols-xl-4 row-cols-md-3 row-cols-2 mt-3">
                        <?php foreach ($produk as $item) : ?>
                            <div class="col-6">
                                <div class="card card-produk h-100 rounded-16">
                                    <a href="#" class="mx-auto mt-3">
                                        <img src="fileUpload/<?= $item['gambar'] ?>" alt="Gambar Produk">
                                    </a>
                                    <div class="card-body h-100 mt-auto">
                                        <a href="#" class="text-secondary text-decoration-none fs-14">
                                            <?= $item["nama_kategori"] ?>
                                        </a>
                                        <h5 class="card-title fs-15 mt-2">
                                            <a href="#" class="card-link fs-14"><?= substr_replace($item["nama_produk"], '...', 45) ?></a>
                                        </h5>
                                        <p class="card-text fw-500 fs-15">
                                            Rp. <?= $item["harga"] ?>
                                        </p>
                                    </div>
                                    <a href="" class="btn btn-green m-3 fs-14">
                                        Tambah ke Keranjang
                                    </a>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <!-- Pagination -->
                    <div class="d-flex justify-content-start mt-3">
                        <nav aria-label="">
                            <ul class="pagination">
                                <li class="page-item  <?php if ($halaman <= 1) {
                                                            echo "disabled";
                                                        } ?>">
                                    <a class="page-link" <?php if ($halaman > 1) {
                                                                echo "href='?halaman=$sebelumnya'";
                                                            } ?>><i class="bi bi-chevron-left"></i></a>
                                </li>
                                <?php for ($i = 1; $i < $total_halaman + 1; $i++) : ?>
                                    <li class="page-item  <?php if ($halaman == $i) {
                                                                echo "active";
                                                            } ?>">
                                        <a class="page-link" href="?halaman=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor ?>
                                <li class="page-item <?php if ($halaman >= $total_halaman) {
                                                            echo "disabled";
                                                        } ?>">
                                    <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                                echo "href='?halaman=$selanjutnya'";
                                                            } ?>><i class="bi bi-chevron-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer style="background-color: #0C1F33;">
        <div class="container py-5 text-white">
            <div class="row">
                <div class="col-md-6">
                    <h1>DOKTER <span style="color:var(--txt-color-blue);">KOMPUTER</span></h1>
                    <p>&copy; Copyright 2022. Dibuat oleh <a href="https://github.com/fazzryan" class="text-cansel">Dinda Fazryan</a></p>
                </div>
                <div class="col-md-3">
                    <p class="fw-500">Dokter Komputer</p>
                    <ul class="list-unstyled">
                        <li class="my-2">
                            <a href="#" class="footer-link">Home</a>
                        </li>
                        <li class="my-2">
                            <a href="#" class="footer-link">Produk</a>
                        </li>
                        <li class="my-2">
                            <a href="#" class="footer-link">Service</a>
                        </li>
                        <li class="my-2">
                            <a href="#" class="footer-link">Konsul</a>
                        </li>
                        <li class="my-2">
                            <a href="#" class="footer-link">Tentang Kami</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <p class="fw-500">Sosial Media</p>
                    <ul class="list-unstyled">
                        <li class="my-2">
                            <a href="#" class="footer-link">Instagram</a>
                        </li>
                        <li class="my-2">
                            <a href="#" class="footer-link">Facebook</a>
                        </li>
                        <li class="my-2">
                            <a href="#" class="footer-link">Youtube</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="asset/js/bootstrap.js"></script>
    <script src="asset/js/script.js"></script>
</body>

</html>