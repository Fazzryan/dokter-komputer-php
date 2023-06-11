<?php
session_start();
include "../db/koneksi.php";
include "../fungsi.php";

if (empty($_SESSION["username"]) || empty($_SESSION["email"]) || empty($_SESSION["password"])) {
    header("Location: ../index.php");
}
// untuk keranjang dinavbar
$user = !empty($_SESSION["id_user"]) ? $_SESSION["id_user"] : "";

$username = $_SESSION["username"];
$email = $_SESSION["email"];
$password = $_SESSION["password"];



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
                        <a href="#" class="kategori-item on">
                            <i class="bi bi-person-fill"></i>
                            <span class="ms-2">Biodata Diri</span>
                        </a>
                        <a href="" class="kategori-item">
                            <i class="bi bi-bag-check-fill"></i>
                            <span class="ms-2">Pesanan</span>
                        </a>
                        <a href="#" class="kategori-item">
                            <i class="bi bi-geo-alt-fill"></i>
                            <span class="ms-2">Alamat</span>
                        </a>
                        <a href="#" class="kategori-item">
                            <i class="bi bi-credit-card-fill"></i>
                            <span class="ms-2">Pembayaran</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card py-3 px-4 border-0 shadow-1 rounded-16 mb-3">
                        <h4>Biodata Diri</h4>
                        <div class="mt-3">
                            <div class="row mb-3">
                                <div class="col-4 col-lg-2">Username</div>
                                <div class="col-8 col-lg-10"><?= $username ?></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 col-lg-2">Tanggal Lahir</div>
                                <div class="col-8 col-lg-10">-</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 col-lg-2">Jenis kelamin</div>
                                <div class="col-8 col-lg-10">-</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 col-lg-2">Email</div>
                                <div class="col-8 col-lg-10"><?= $email ?></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 col-lg-2">Nomor HP</div>
                                <div class="col-8 col-lg-10">-</div>
                            </div>
                            <a href="editbiodata.php?username=<?= $username ?>&email=<?= $email ?>" class="btn btn-green">Edit Biodata</a>
                        </div>
                        <hr class="my-4">
                        <h4>Password</h4>
                        <div class="mt-3">
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-2">
                                            <label for="password_baru" class="form-label">Password Baru</label>
                                            <input type="password" name="password_baru" class="form-control">
                                            <div class="fs-14 mt-2 text-muted">Lupa password? <a href="" class="text-green">Reset password</a>.</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-2">
                                            <label for="password_lama" class="form-label">Password Saat ini</label>
                                            <input type="password" name="password_lama" class="form-control" value="<?= $password ?>">
                                            <div class="fs-14 mt-2 text-muted">Password di atas telah di enkripsi.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="button" name="simpan_password" class="btn btn-green">Simpan Password</button>
                                </div>
                            </form>
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