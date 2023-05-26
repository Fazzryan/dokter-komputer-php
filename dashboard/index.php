<?php
include "../fungsi.php";

$total_produk = show("SELECT COUNT(*) AS total FROM produk");
$total_kategori = show("SELECT COUNT(*) AS total FROM kategori");
// var_dump($total_kategori);
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
    <title>Dashboard - Dokter Komputer</title>
</head>

<body class="bg-white">
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="">
            <!-- <hr class="text-secondary"> -->
            <ul class="navbar-nav">
                <div class="side-header">
                    <h5>Dokter Komputer</h5>
                    <button type="button" class="btn-close d-xl-none" aria-label="Close"></button>
                </div>
                <li class="nav-item">
                    <a href="#" class="side-link on"><i class="bi bi-house me-2"></i> Dashboard</a>
                </li>
                <li class="nav-item my-3 ps-3">
                    <span class="nav-label">Store Manajemen</span>
                </li>
                <li class="nav-item">
                    <a href="produk/" class="side-link"><i class="bi bi-cart me-2"></i> Produk</a>
                </li>
                <li class="nav-item">
                    <a href="kategori/" class="side-link"><i class="bi bi-list-ul me-2"></i> Kategori</a>
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
                <div class="container-fluid">
                    <div class="row g-3">
                        <div class="col-md-6 col-xl-4">
                            <div class="card shadow-1 rounded-16 border-0">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title">Total Produk</h5>
                                        <div class="d-flex justify-content-center align-items-center text-center bg-blue rounded-circle" style="width: 2.5rem; height:2.5rem;">
                                            <i class="bi bi-cart"></i>
                                        </div>
                                    </div>
                                    <h2><?= $total_produk[0]["total"] ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="card shadow-1 rounded-16 border-0">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title">Total Kategori</h5>
                                        <div class="d-flex justify-content-center align-items-center text-center bg-green rounded-circle" style="width: 2.5rem; height:2.5rem;">
                                            <i class="bi bi-list-ul"></i>
                                        </div>
                                    </div>
                                    <h2><?= $total_kategori[0]["total"] ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="../asset/js/bootstrap.js"></script>
    <script src="../asset/js/script.js"></script>
</body>

</html>