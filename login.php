<?php
include "db/koneksi.php";
include "fungsi.php";


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
    <title>Login - Dokter Komputer</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-1 border-0">
        <div class="container justify-content-center justify-content-md-between align-items-center">
            <a class="navbar-brand" href="#">Dokter Komputer</a>
            <span class="ln-30 fw-400">Belum punya akun? <a href="registrasi.php">Registrasi</a></span>
        </div>
    </nav>
    <section class="auth">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-6 col-lg-5 col-xl-4 my-4 mb-lg-0 text-center text-md-start">
                    <img src="asset/img/login-dk.svg" alt="icon">
                </div>
                <div class="col-12 col-md-6 col-lg-5 col-xl-4">
                    <div class="mb-4">
                        <h3>Login ke Dokter Komputer</h3>
                        <p>Selamat datang di Dokter Komputer. Masukan email anda untuk memulai aplikasi.</p>
                    </div>
                    <form action="" method="post">
                        <div class="mb-2">
                            <input type="text" class="form-control" name="email" required autocomplete="off" placeholder="Email">
                        </div>
                        <div class="mb-2">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="mb-2">
                            <button type="submit" name="login" class="btn btn-green w-100 fw-500">Login</button>
                        </div>
                    </form>
                    <p>Belum punya akun? <a href="registrasi.php" class="text-green">Registrasi</a></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer style="background-color: #0C1F33;">
        <div class="container py-5 text-white">
            <div class="row">
                <div class="col-md-6">
                    <h1>DOKTER <span style="color:var(--txt-color-blue);">KOMPUTER</span></h1>
                    <p>&copy; Copyright 2022. Dibuat oleh <a href="https://github.com/fazzryan" class="text-cansel">Dinda Fazryan</a></p>
                </div>
                <div class="col-md-3">
                    <p class="fw-500">Dokter Komputer</p>
                    <ul class="list-unstyled">
                        <li class="my-2">
                            <a href="#" class="footer-link">Home</a>
                        </li>
                        <li class="my-2">
                            <a href="#" class="footer-link">Produk</a>
                        </li>
                        <li class="my-2">
                            <a href="#" class="footer-link">Service</a>
                        </li>
                        <li class="my-2">
                            <a href="#" class="footer-link">Konsul</a>
                        </li>
                        <li class="my-2">
                            <a href="#" class="footer-link">Tentang Kami</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <p class="fw-500">Sosial Media</p>
                    <ul class="list-unstyled">
                        <li class="my-2">
                            <a href="#" class="footer-link">Instagram</a>
                        </li>
                        <li class="my-2">
                            <a href="#" class="footer-link">Facebook</a>
                        </li>
                        <li class="my-2">
                            <a href="#" class="footer-link">Youtube</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="asset/js/bootstrap.js"></script>
    <script src="asset/js/script.js"></script>
</body>

</html>