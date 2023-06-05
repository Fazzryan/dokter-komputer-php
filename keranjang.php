<?php
session_start();
include "db/koneksi.php";
include "fungsi.php";

$user = !empty($_SESSION["id_user"]) ? $_SESSION["id_user"] : "";

$produk = show("SELECT * FROM keranjang 
LEFT JOIN produk 
ON keranjang.id_produk = produk.id_produk
LEFT JOIN user
ON keranjang.id_user = user.id_user
WHERE keranjang.id_user = '$user'
");

$total_produk = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM keranjang WHERE id_user = '$user'");
$jumlah_produk = mysqli_fetch_row($total_produk);

foreach ($jumlah_produk as $x) {
    $harga = mysqli_query($koneksi, "SELECT SUM(jumlah_produk * harga_produk) AS total FROM keranjang WHERE id_user = '$user'");
    $total_harga = mysqli_fetch_row($harga);
    $qty = show("SELECT SUM(jumlah_produk) AS total FROM keranjang WHERE id_user = '$user'");
}
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
    <title>Keranjang - Dokter Komputer</title>
</head>

<body>

    <?php include "navbar.php" ?>
    <!-- Hero -->
    <section class="keranjang">
        <div class="container h-100">
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
                    </ol>
                </nav>
            </div>
            <div class="row justify-content-center mt-3 mt-md-5">
                <?php if ($jumlah_produk < 1) : ?>
                    <div class="col-12 col-lg-9 col-xl-7 text-center">
                        <img src="asset/img/empty_cart.svg" class="w-50" alt="icon">
                        <div class="mt-4 empty-cart">
                            <h3>Wah, keranjang belanjamu kosong</h3>
                            <p>Yuk, mulai belanja dan lengkapi kebutuhanmu di Dokter Komputer!</p>
                            <a href="produk.php" class="btn btn-green px-5  fw-500">Mulai Belanja</a>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="col-12 col-lg-8">
                        <?php foreach ($produk as $item) : ?>
                            <div class="row align-items-center py-3 border-bottom">
                                <div class="col-3">
                                    <img src="fileUpload/<?= $item['gambar'] ?>" class="keranjang_img" alt="produk">
                                </div>
                                <div class="col-7">
                                    <div class="p-2">
                                        <h6 class="fs-14"><?= $item["nama_produk"] ?></h6>
                                        <div class="fs-14 ">Berat : <?= substr($item["berat"], 0, 50) ?></div>
                                        <div class="fs-14">Jumlah : <?= $item["jumlah_produk"] ?></div>
                                        <div class="fs-14 ">Harga : Rp. <?= formatKeRupiah($item["harga"]) ?></div>
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
                                <span>Total Harga (<?= $qty[0]["total"] ?> barang)</span>
                                <span>Rp. <?= formatKeRupiah($total_harga[0]) ?></span>
                            </div>
                            <div class="d-flex justify-content-between border-top">
                                <span class="fw-500 mt-3">Total Harga</span>
                                <span class="fw-500 mt-3">Rp. <?= formatKeRupiah($total_harga[0]) ?></span>
                            </div>
                            <div class="mt-3">
                                <a href="#" class="btn btn-green w-100 fw-500">Beli (<?= $qty[0]["total"] ?>)</a>
                            </div>
                        </div>
                    </div>
                <?php endif ?>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include "footer.php" ?>

    <script src="asset/js/bootstrap.js"></script>
    <script src="asset/js/script.js"></script>
</body>

</html>