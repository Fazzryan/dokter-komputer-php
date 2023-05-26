<?php
include "../../db/koneksi.php";
include "../../fungsi.php";

$id_kategori = $_GET["id_kategori"];
$kategori = show("SELECT * FROM kategori WHERE id_kategori = '$id_kategori'");

if (isset($_POST["edit"])) {
    if (editKategori($_POST) > 0) {
        echo "
            <script>
                alert('Kategori berhasil diupdate');
                window.location.href='index.php';
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
    <title>Tambah Kategori - Dokter Komputer</title>
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
                            <h3> Tambah Kategori</h3>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item">Kategori</li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Kategori</li>
                                </ol>
                            </nav>
                        </div>
                        <a href="index.php" class="btn btn-gray fw-500">Kembali ke Kategori</a>
                    </div>

                    <div class="row mt-3 mt-md-4">
                        <div class="col-12 col-md-6">
                            <div class="card p-3 p-lg-4 p-2 border-1 shadow-1 rounded-16 mb-3">

                                <form action="" method="post"">
                                <div class=" mb-3">
                                    <label for="nama_kategori" class="form-label fw-500">Nama Kategori</label>
                                    <input type="hidden" name="id_kategori" value="<?= $kategori[0]['id_kategori'] ?>"">
                                <input type=" text" class="form-control" id="nama_kategori" name="nama_kategori" required autocomplete="off" value="<?= $kategori[0]['nama_kategori'] ?>">
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="edit" class="btn btn-green">Edit Kategori</button>
                            </div>
                        </div>
                        </form>
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