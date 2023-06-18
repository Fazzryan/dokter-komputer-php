<?php
session_start();
include "db/koneksi.php";
include "fungsi.php";

$user = !empty($_SESSION["id_user"]) ? $_SESSION["id_user"] : "";
// gambar untuk navbar
if ($user) {
    $data_user = show("SELECT * FROM user WHERE id_user = '$user'");
    if ($data_user[0]["picture"]) {
        $picture = "userPicture/" . $data_user[0]["picture"];
    } else {
        $picture = "asset/img/profile_default.png";
    }
}

$slug = $_GET["slug"];
$produk = show("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE slug = '$slug'");
// var_dump($produk);
// die;

if (isset($_POST["tambah_keranjang"])) {
    if (empty($_SESSION["username"]) || empty($_SESSION["email"])) {
        echo "
            <script>
                alert('Login terlebih dahulu');
            </script>
        ";
    } else {
        if (tambah_keranjang($_POST) > 0) {
            echo "
            <script>
                alert('Produk berhasil ditambahkan');
            </script>
        ";
        } else {
            echo "
            <script>
                alert('Produk gagal ditambahkan');
            </script>
        ";
        }
    }
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
    <title><?= $produk[0]["nama_produk"] ?> - Dokter Komputer</title>
</head>

<body>

    <?php include "navbar.php" ?>

    <section class="detailProduk">
        <div class="container mb-5">
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="produk.php">Produk</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $produk[0]["nama_produk"] ?></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="container mb-3">
            <div class="row">
                <div class="col-12 col-lg-6 mb-5">
                    <img src="fileUpload/<?= $produk[0]['gambar'] ?>" alt="Gambar">
                </div>
                <div class="col-12 col-lg-6">
                    <div class="ps-lg-5">
                        <a href="produkberdasarkan.php?katakunci=<?= $produk[0]["nama_kategori"] ?>" class="mb-2 d-block text-green fw-500"><?= $produk[0]["nama_kategori"] ?></a>
                        <h2 class="mb-3"><?= $produk[0]["nama_produk"] ?></h2>
                        <div class="d-flex mb-4">
                            <?php if ($produk[0]["harga_diskon"]) : ?>
                                <span class="fw-500 text-dark">Rp<?= formatKeRupiah($produk[0]["harga_diskon"]) ?></span>
                            <?php endif ?>
                            <?php if (!$produk[0]["harga_diskon"]) : ?>
                                <span class="fw-500 text-dark">Rp<?= formatKeRupiah($produk[0]["harga_normal"]) ?></span>
                            <?php else : ?>
                                <small class="fw-500 text-muted ms-2"><s>Rp<?= formatKeRupiah($produk[0]["harga_normal"]) ?></s></small>
                            <?php endif ?>
                        </div>
                        <p>Jumlah Item</p>
                        <form action="" method="post">
                            <div class="d-flex">
                                <input type="hidden" name="id_produk" value="<?= $produk[0]["id_produk"] ?>">
                                <input type="hidden" name="id_user" value="<?= $user ?>">
                                <?php if ($produk[0]["harga_diskon"]) : ?>
                                    <input type="hidden" name="harga_produk" value="<?= $produk[0]["harga_diskon"] ?>">
                                <?php else : ?>
                                    <input type="hidden" name="harga_produk" value="<?= $produk[0]["harga_normal"] ?>">
                                <?php endif ?>

                                <input type="number" name="jumlah_produk" min="1" id="jumlah_produk" class="form-control w-50 me-2" value="1">
                                <button type="submit" name="tambah_keranjang" class="btn btn-green w-50"><i class="bi bi-cart"></i> Tambah ke Keranjang</button>
                            </div>
                        </form>
                        <div class="mt-4">
                            <div class="fs-15 text-muted">Kondisi : <span class="text-dark fw-500"><?= $produk[0]["kondisi"] ?></span></div>
                            <div class="fs-15 text-muted">Berat : <span class="text-dark fw-500"><?= $produk[0]["berat"] ?></span></div>
                            <div class="fs-15 text-muted">Min. Pemesanan : <span class="text-dark fw-500">1 Buah</span></div>
                        </div>
                        <div class="my-4">
                            <div class="d-block d-md-flex">
                                <div class="me-3">
                                    <i class="bi bi-truck"></i>
                                </div>
                                <div class="fs-15">
                                    <span class="mb-1 fw-500">Gratis Ongkir</span>
                                    <p class="text-muted">Gratis ongkir dengan min. belanja Rp 3.500.000</p>
                                </div>
                            </div>
                            <div class="d-block d-md-flex">
                                <div class="me-3">
                                    <i class="bi bi-shield-check"></i>
                                </div>
                                <div class="fs-15">
                                    <span class="mb-1 fw-500">Proteksi Kerusakan Produk</span>
                                    <p class="text-muted">Jaminan produk diterima dalam keadaan baik</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fs-14 active" id="deskripsi-tab" data-bs-toggle="tab" data-bs-target="#deskripsi" type="button" role="tab" aria-controls="deskripsi" aria-selected="true">Deskripsi Produk</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fs-14" id="ulasan-tab" data-bs-toggle="tab" data-bs-target="#ulasan" type="button" role="tab" aria-controls="ulasan" aria-selected="false">Ulasan</button>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="deskripsi" role="tabpanel" aria-labelledby="deskripsi-tab">
                            <div class="my-4">
                                <div class="fs-14">
                                    <?= $produk[0]["deskripsi"] ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="ulasan" role="tabpanel" aria-labelledby="ulasan-tab">
                            <div class="my-4">

                                <div class="row">
                                    <div class="col-lg-8">
                                        <h5 class="mb-4">Ulasan</h5>
                                        <div>
                                            <h6 class="fw-500">Maysari - <span class="text-muted">Puas</span></h6>
                                            <div class="text-muted mb-1 fs-14">2022-6-25</div>
                                            <p class="border-bottom mt-2 pb-2">
                                                Pengiriman cepat, packing juga rapih. barang belum di coba. Mudah-mudahan aman
                                            </p>
                                        </div>
                                        <div>
                                            <h6 class="fw-500">Maysari - <span class="text-muted">Puas</span></h6>
                                            <div class="text-muted mb-1 fs-14">2022-6-25</div>
                                            <p class="border-bottom mt-2 pb-2">
                                                Pengiriman cepat, packing juga rapih. barang belum di coba. Mudah-mudahan aman
                                            </p>
                                        </div>
                                        <div>
                                            <h6 class="fw-500">Maysari - <span class="text-muted">Puas</span></h6>
                                            <div class="text-muted mb-1 fs-14">2022-6-25</div>
                                            <p class="border-bottom mt-2 pb-2">
                                                Pengiriman cepat, packing juga rapih. barang belum di coba. Mudah-mudahan aman
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <h5 class="mb-4">Tulis Ulasan</h5>
                                        <form action="" method="post">
                                            <div class="mb-2">
                                                <input type="text" class="form-control" name="nama" placeholder="Nama">
                                            </div>
                                            <div class="mb-2">
                                                <input type="email" class="form-control" name="email" placeholder="Email">
                                            </div>
                                            <div class="mb-2">
                                                <select name="rating" class="form-select">
                                                    <option value="Pilih Rating" disabled selected>Pilih Rating</option>
                                                    <option value="Tidak Puas">Tidak Puas</option>
                                                    <option value="Cukup Puas">Cukup Puas</option>
                                                    <option value="Sangat Puas">Sangat Puas</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <textarea name="pesan" cols="30" rows="5" class="form-control" placeholder="Pesan"></textarea>
                                            </div>
                                            <button type="submit" name="kirim_pesan" class="btn btn-green w-100">Kirim Pesan</button>
                                        </form>
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