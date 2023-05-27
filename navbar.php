<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top border-bottom">
    <div class="container py-2 ">
        <a class="navbar-brand" href="#">Dokter Komputer</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item px-2">
                    <a class="nav-link ln-30 fw-400 <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link ln-30 fw-400 <?php echo basename($_SERVER['PHP_SELF']) == 'produk.php' ? 'active' : ''; ?>" href="produk.php">Produk</a>
                </li>
                <li class="nav-item px-2">
                    <a href="service.php" class="nav-link ln-30 fw-400 <?php echo basename($_SERVER['PHP_SELF']) == 'service.php' ? 'active' : ''; ?>">Service</a>
                </li>
                <li class="nav-item px-2">
                    <a href="#" class="nav-link ln-30 fw-400 <?php echo basename($_SERVER['PHP_SELF']) == 'konsul.php' ? 'active' : ''; ?>">Konsul</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link ln-30 fw-400 <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>" href="#">Tentang Kami</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="btn btn-green mx-lg-2 position-relative">
                        <i class="bi bi-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-cansel">
                            1
                        </span>
                    </a>
                    <a class="btn btn-green mx-lg-1 d-lg-none" aria-current="page" href="#">
                        <i class="bi bi-person"></i>
                    </a>
                </li>
                <li class="nav-item mt-1 mt-lg-0 d-none d-lg-block">
                    <a class="btn btn-green mx-lg-1" aria-current="page" href="#">
                        <i class="bi bi-person"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>