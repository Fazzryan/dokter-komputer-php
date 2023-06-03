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
    <title>Registrasi - Dokter Komputer</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-1 border-0">
        <div class="container justify-content-center justify-content-md-between align-items-center">
            <a class="navbar-brand" href="#">Dokter Komputer</a>
            <span class="ln-30 fw-400">Sudah punya akun? <a href="login.php">login</a></span>
        </div>
        </div>
    </nav>
    <section class="auth">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-6 col-lg-5 col-xl-4 my-4 mb-lg-0 text-center text-md-start">
                    <img src="asset/img/register-dk.svg" alt="icon">
                </div>
                <div class="col-12 col-md-6 col-lg-5 col-xl-4">
                    <div class="mb-4">
                        <h3>Mari mulai berbelanja</h3>
                        <p>Selamat datang di Dokter Komputer. Buat akun anda untuk memulai aplikasi.</p>
                    </div>
                    <form action="" method="post">
                        <div class="mb-2">
                            <input type="text" class="form-control" name="email" required autocomplete="off" placeholder="Username">
                        </div>
                        <div class="mb-2">
                            <input type="email" class="form-control" name="email" required autocomplete="off" placeholder="Email">
                        </div>
                        <div class="mb-2">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="mb-2">
                            <button type="submit" name="registrasi" class="btn btn-green w-100 fw-500">Registrasi</button>
                        </div>
                    </form>
                    <p>Sudah punya akun? <a href="login.php" class="text-green">Login</a></p>
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