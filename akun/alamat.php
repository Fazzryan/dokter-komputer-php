<?php
session_start();
include "../db/koneksi.php";
include "../fungsi.php";

if (empty($_SESSION["username"]) || empty($_SESSION["email"]) || empty($_SESSION["password"])) {
    header("Location: ../index.php");
}
// untuk keranjang dinavbar
$user = !empty($_SESSION["id_user"]) ? $_SESSION["id_user"] : "";

$data_user = show("SELECT * FROM user WHERE id_user = '$user'");

$username = $data_user[0]["username"];
$email = $data_user[0]["email"];
$password = $data_user[0]["password"];

// Buat navbar
if ($data_user[0]["picture"]) {
    $picture = "../userPicture/" . $data_user[0]["picture"];
} else {
    $picture = "../asset/img/profile_default.png";
}

if (isset($_POST["ubah_foto"])) {

    var_dump($_POST);
    die;
    if (addUserPicture($_POST) > 0) {
        echo "
            <script>
                alert('Foto berhasil diubah!');
            </script>
        ";
    }
}
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
    <title>Alamat - Dokter Komputer</title>
</head>

<body>

    <?php include "navbar.php" ?>

    <section id="hero">
        <div class="container mb-3">
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Akun</li>
                        <li class="breadcrumb-item active" aria-current="page">Biodata Diri</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card p-3 border-0 shadow-1 rounded-16 mb-3">
                        <a href="setting.php" class="kategori-item">
                            <i class="bi bi-person-fill"></i>
                            <span class="ms-2">Biodata Diri</span>
                        </a>
                        <a href="pesanan.php" class="kategori-item">
                            <i class="bi bi-bag-check-fill"></i>
                            <span class="ms-2">Pesanan</span>
                        </a>
                        <a href="alamat.php" class="kategori-item on">
                            <i class="bi bi-geo-alt-fill"></i>
                            <span class="ms-2">Alamat</span>
                        </a>
                        <a href="pembayaran.php" class="kategori-item">
                            <i class="bi bi-credit-card-fill"></i>
                            <span class="ms-2">Pembayaran</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card py-3 px-4 border-0 shadow-1 rounded-16 mb-3">
                        <div class="row mb-3 justify-content-between align-items-center">
                            <div class="col-6">
                                <h4>Alamat</h4>
                            </div>
                            <div class="col-6 text-end ">
                                <a href="tambahalamat.php" class="btn btn-green">Tambah Alamat</a>
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-lg-2 g-2 g-lg-3">
                            <div class="col">
                                <div class="card rounded-16 p-1">
                                    <div class="card-body">
                                        <h6 class="card-subtitle text-muted">Rumah</h6>
                                        <h5 class="card-title">Dinda Fazryan</h5>
                                        <span class="card-subtitle">087123123</span>
                                        <p class="card-text">jl bojonghuni rt 1 rw 12 kel maleber kec ciamis jawa barat (sebelah kiri warung kakapean, warna kuning)</p>
                                        <a href="#" class="btn btn-green fs-14 me-1">Ubah Alamat</a>
                                        <a href="#" class="btn btn-gray fs-14 ">Hapus</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card rounded-16 p-1">
                                    <div class="card-body">
                                        <h6 class="card-subtitle text-muted">Rumah</h6>
                                        <h5 class="card-title">Dinda Fazryan</h5>
                                        <span class="card-subtitle">087123123</span>
                                        <p class="card-text">jl bojonghuni rt 1 rw 12 kel maleber kec ciamis jawa barat (sebelah kiri warung kakapean, warna kuning)</p>
                                        <a href="#" class="btn btn-green fs-14 me-1">Ubah Alamat</a>
                                        <a href="#" class="btn btn-gray fs-14 ">Hapus</a>
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
    <?php include "../footer.php" ?>


    <script src="../asset/js/bootstrap.js"></script>
    <script src="../asset/js/script.js"></script>
</body>

</html>