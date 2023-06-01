<?php
include "db/koneksi.php";
include "fungsi.php";

$produk = show("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori = kategori.id_kategori LIMIT 4");

// var_dump($aksesoris_headset);
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
    <!-- Hero -->
    <section class="keranjang">
        <div class="container">
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
                    </ol>
                </nav>
            </div>
            <div class="row mt-lg-4">
                <div class="col-12">
                    <h3>Keranjang</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-8">
                    <?php foreach ($produk as $item) : ?>
                        <div class="row align-items-center py-3 border-bottom">
                            <div class="col-3">
                                <img src="fileUpload/<?= $item['gambar'] ?>" alt="produk">
                            </div>
                            <div class="col-7">
                                <div class="p-2">
                                    <h6 class="fs-14"><?= $item["nama_produk"] ?></h6>
                                    <div class="fs-14 ">Berat : <?= substr($item["berat"], 0, 50) ?></div>
                                    <div class="fs-14">Jumlah : 1</div>
                                    <div class="fs-14 ">Harga : Rp. <?= $item["harga"] ?></div>
                                </div>
                            </div>
                            <div class="col-2 text-end">
                                <form action="" method="post">
                                    <input type="hidden" name="slug" value="<?= $item['slug'] ?>">
                                    <button type="submit" name="hapusCartProduk" class="btn btn-danger fs-14"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
                <div class="col-12 col-lg-4 mt-3 mt-lg-0">
                    <div class="border rounded-16 p-3 p-lg-4">
                        <div class="fs-16 fw-500">Ringkasan Belanja</div>
                        <div class="d-flex justify-content-between fs-14 my-3">
                            <span>Total Harga (4 barang)</span>
                            <span>Rp. 400.000</span>
                        </div>
                        <div class="d-flex justify-content-between border-top">
                            <span class="fw-500 mt-3">Total Harga</span>
                            <span class="fw-500 mt-3">Rp. 400.000</span>
                        </div>
                        <div class="mt-3">
                            <a href="#" class="btn btn-green w-100 fw-500">Beli (4)</a>
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