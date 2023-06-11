<?php
session_start();
include "../db/koneksi.php";
include "../fungsi.php";

$user = !empty($_SESSION["id_user"]) ? $user = $_SESSION["id_user"] : $user = "";
// var_dump($jumlah_produk);
// die;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/css/bootstrap.css">
    <link rel="stylesheet" href="../asset/css/style.css">
    <!-- Bs Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Setting - Dokter Komputer</title>
</head>

<body>

    <?php include "navbar.php" ?>

    <section id="hero">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <div class="card p-3 border-0 shadow-1 rounded-16 mb-3">
                        <a href="#" class="kategori-item on">
                            <i class="bi bi-bag-check-fill"></i>
                            <span class="ms-2">Pesanan</span>
                        </a>
                        <a href="#" class="kategori-item on">
                            <i class="bi bi-person-fill"></i>
                            <span class="ms-2">Biodata Diri</span>
                        </a>
                        <a href="#" class="kategori-item on">
                            <i class="bi bi-geo-alt-fill"></i>
                            <span class="ms-2">Alamat</span>
                        </a>
                        <a href="#" class="kategori-item on">
                            <i class="bi bi-credit-card-fill"></i>
                            <span class="ms-2">Pembayaran</span>
                        </a>
                    </div>
                </div>
                <div class="col-8"></div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <?php include "../footer.php" ?>


    <script src="../asset/js/bootstrap.js"></script>
    <script src="../asset/js/script.js"></script>
</body>

</html>