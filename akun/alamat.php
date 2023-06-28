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
    <style>
        #modal {
            display: none;
            position: fixed;
            z-index: 999;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.6);
        }

        #modal-content {
            display: block;
            margin: auto;
            width: 80%;
            max-width: 800px;
            max-height: 80%;
            margin-top: 10%;
        }

        #modal-content img {
            width: 100%;
            height: auto;
            border-radius: 1rem;
        }

        @media (max-width: 768px) {
            #modal-content {
                position: relative;
                top: 40%;
                transform: translateY(-40%);
            }
        }
    </style>
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
                        <a href="setting.php" class="kategori-item on">
                            <i class="bi bi-person-fill"></i>
                            <span class="ms-2">Biodata Diri</span>
                        </a>
                        <a href="pesanan.php" class="kategori-item">
                            <i class="bi bi-bag-check-fill"></i>
                            <span class="ms-2">Pesanan</span>
                        </a>
                        <a href="alamat.php" class="kategori-item">
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
                        <div class="row">
                            <div class="col-12 col-lg-7">

                                <h4>Biodata Diri</h4>
                                <div class="mt-3">
                                    <div class="row mb-3">
                                        <div class="col-5 col-lg-4">Username</div>
                                        <div class="col-7 col-lg-8"><?= $username ?></div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-5 col-lg-4">Tanggal Lahir</div>
                                        <div class="col-7 col-lg-8">
                                            <?php $tgl = $data_user[0]["tanggal_lahir"] ? $data_user[0]["tanggal_lahir"] : "-";
                                            echo $tgl; ?>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-5 col-lg-4">Jenis kelamin</div>
                                        <div class="col-7 col-lg-8">
                                            <?php $jk = $data_user[0]["jenis_kelamin"] ? $data_user[0]["jenis_kelamin"] : "-";
                                            echo $jk; ?>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-5 col-lg-4">Email</div>
                                        <div class="col-7 col-lg-8"><?= $email ?></div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-5 col-lg-4">Nomor HP</div>
                                        <div class="col-7 col-lg-8">
                                            <?php $nohp = $data_user[0]["nomorhp"] ? $data_user[0]["nomorhp"] : "-";
                                            echo $nohp; ?>
                                        </div>
                                    </div>
                                    <a href="editbiodata.php?id_user=<?= $user ?>" class="btn btn-green">Edit Biodata</a>
                                </div>
                            </div>
                            <div class="col-12 col-lg-5 text-lg-center mt-4 mt-lg-0">
                                <img src="<?= $picture ?>" alt="profile" style="border-radius: 6px; aspect-ratio: auto; cursor:pointer;" onclick="openModal(event, this)">
                            </div>
                        </div>
                        <!-- Modal -->
                        <div id="modal">
                            <span onclick="closeModal()" style="color: white; position: absolute; top: 120px; right: 20px; font-size: 30px; cursor: pointer;">&times;</span>
                            <div id="modal-content">
                                <img id="modal-image" src="" alt="">
                            </div>
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