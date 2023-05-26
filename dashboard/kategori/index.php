<?php
include "../../db/koneksi.php";
include "../../fungsi.php";

// $id_kategori = $_GET["id_kategori"];
// Pagination
$batas_halaman = 10;
$halaman = isset($_GET["halaman"]) ? (int) $_GET["halaman"] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas_halaman) - $batas_halaman : 0;

$sebelumnya = $halaman - 1;
$selanjutnya = $halaman + 1;
$data_kategori = mysqli_query($koneksi, "SELECT * FROM kategori");

$jumlah_data = mysqli_num_rows($data_kategori);
$total_halaman = ceil($jumlah_data / $batas_halaman);
$nomor = $halaman_awal + 1;

$kategori = show("SELECT * FROM kategori LIMIT $halaman_awal, $batas_halaman");

if (isset($_POST["tambah"])) {
    if (addKategori($_POST) > 0) {
        echo "
        <script>
            alert('Kategori berhasil ditambahkan');
            window.location.href='index.php'
        </script>
    ";
    }
}

if (isset($_POST["edit"])) {
    if (editKategori($_POST) > 0) {
        echo "
        <script>
            alert('Kategori berhasil diedit');
            window.location.href='index.php'
        </script>
    ";
    }
}

if (isset($_POST["hapus"])) {
    $id_kategori = $_POST["id_kategori"];
    if (deleteKategori($id_kategori) > 0) {
        echo "
        <script>
            alert('Kategori berhasil dihapus');
            window.location.href='index.php'
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
    <link rel="stylesheet" href="../../asset/css/bootstrap.css">
    <link rel="stylesheet" href="../../asset/css/style.css">
    <!-- Bs Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Kategori - Dokter Komputer</title>
</head>

<body class="bg-white">

    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="">
            <ul class="navbar-nav">
                <div class="side-header">
                    <h5>Dokter Komputer</h5>
                    <button type="button" class="btn-close d-xl-none" aria-label="Close"></button>
                </div>
                <li class="nav-item">
                    <a href="../" class="side-link"><i class="bi bi-house me-2"></i> Dashboard</a>
                </li>
                <li class="nav-item my-3 ps-3">
                    <span class="nav-label">Store Manajemen</span>
                </li>
                <li class="nav-item">
                    <a href="../produk/" class="side-link"><i class="bi bi-cart me-2"></i> Produk</a>
                </li>
                <li class="nav-item">
                    <a href="../kategori/" class="side-link on"><i class="bi bi-list-ul me-2"></i> Kategori</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="side-link"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
                </li>
            </ul>
        </nav>
        <!-- Page Content -->
        <div id="content">
            <nav class="navbar content-header">
                <div class="container-fluid px-4">
                    <button type="button" id="sidebarCollapse" class="btn btn-gray d-xl-none">
                        <span>
                            <i class="bi bi-list"></i>
                        </span>
                    </button>
                    <div class="d-flex">
                        <h5>Selemat Datang Admin</h5>
                    </div>
                </div>
            </nav>

            <div class="content-body">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3>Kategori</h3>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Kategori</li>
                                </ol>
                            </nav>
                        </div>
                        <a href="tambahKategori.php" class="btn btn-green">Tambah Kategori</a>
                    </div>

                    <div class="row mt-3 justify-content-between">
                        <div class="col-12">
                            <div class="card h-100 p-lg-4 p-2 border-1 shadow-1 rounded-16 mb-3">
                                <div class="table-responsive">
                                    <table class="table fs-15">
                                        <thead>
                                            <tr>
                                                <th class="fw-500">No</th>
                                                <th class="fw-500">Nama Kategori</th>
                                                <th class="fw-500">Jumlah Produk</th>
                                                <th class="fw-500">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($kategori as $item) : ?>
                                                <tr>
                                                    <td scope="row"><?= $nomor  ?></td>
                                                    <td><?= $item["nama_kategori"] ?></td>
                                                    <td class="fw-500">
                                                        <?php $jumlah_produk = show("SELECT COUNT(*) as jumlah FROM produk WHERE id_kategori = $item[id_kategori]");
                                                        echo ($jumlah_produk[0]['jumlah']); ?>
                                                    </td>
                                                    <td>
                                                        <a href="editKategori.php?id_kategori=<?= $item['id_kategori'] ?>" class="btn btn-gray"><i class="bi bi-pencil"></i></a>
                                                        <form action="" method="post" class="d-inline">
                                                            <input type="hidden" name="id_kategori" value="<?= $item['id_kategori'] ?>">
                                                            <button type="submit" name="hapus" class="btn btn-gray" onclick="return confirm('Yakin hapus?')"><i class="bi bi-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?php $nomor++ ?>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-end">
                                        <nav aria-label="">
                                            <ul class="pagination">
                                                <li class="page-item  <?php if ($halaman <= 1) {
                                                                            echo "disabled";
                                                                        } ?>">
                                                    <a class="page-link" <?php if ($halaman > 1) {
                                                                                echo "href='?halaman=$sebelumnya'";
                                                                            } ?>>Previous</a>
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
                                                                            } ?>>Next</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="../../asset/js/bootstrap.js"></script>
    <script src="../../asset/js/script.js"></script>

</body>

</html>