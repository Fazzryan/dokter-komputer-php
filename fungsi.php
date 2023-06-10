<?php
include "db/koneksi.php";

// Login
function login($data)
{
    global $koneksi;

    $email = $data["email"];
    $password = $data["password"];

    $user = mysqli_query($koneksi, "SELECT * FROM user WHERE email = '$email'");
    if (mysqli_num_rows($user) === 1) {
        $data = mysqli_fetch_assoc($user);
        if (password_verify($password, $data["password"])) {
            $_SESSION['id_user'] = $data['id_user'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['password'] = $data['password'];
        }
    }
    return mysqli_affected_rows($koneksi);
}
// Logout
function logout()
{
    session_destroy();
    echo "
    <script>
        alert('Berhasil Logout!'); 
        window.location ='login.php';
    </script>";
}
// Buat Akun
function adduser($data)
{
    global $koneksi;

    $username = htmlspecialchars($data["username"]);
    $email = htmlspecialchars($data["email"]);
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $konfir_password = mysqli_real_escape_string($koneksi, $data["password"]);

    if ($password !== $konfir_password) {
        echo "<script>
        alert('Password tidak sesuai');
        </script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $tambahUser = mysqli_query($koneksi, "INSERT INTO user (id_user, username, email, password) VALUES ('', '$username', '$email', '$password')");
    if ($tambahUser) {
        return mysqli_affected_rows($koneksi);
    }
}
// Ambil data 
function show($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// Tambah Produk
function addProduk($data)
{
    global $koneksi;

    $nama_produk = htmlspecialchars($data["nama_produk"]);
    $slug = htmlspecialchars($data["slug"]);
    $id_kategori = htmlspecialchars($data["id_kategori"]);
    $harga = htmlspecialchars($data["harga"]);
    $kondisi = htmlspecialchars($data["kondisi"]);
    $berat = htmlspecialchars($data["berat"]);
    $deskripsi = $data["deskripsi"];

    if ($nama_produk == "" || $slug == "" || $id_kategori == "" || $harga == "" || $kondisi == "" || $berat == "" || $deskripsi == "") {
        echo "
            <script>
                alert('Lengkapi semua data!')
            </>
        ";
        return;
    }

    $target_dir = "../../fileUpload/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    $gambar = basename($_FILES["gambar"]["name"]);
    $ukuran_file = $_FILES["gambar"]["size"];
    $tipe_file = $_FILES["gambar"]["type"];
    $upload_berhasil = 1;
    $tipe_file = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (file_exists($target_file)) {
        echo "
            <script>
                alert('File sudah ada, ganti nama gambar!')
                window.location='tambahProduk.php'
            </script>
        ";
        $upload_berhasil = 0;
    }
    // Cek Ukuran File, ukuran dalam byte
    if ($ukuran_file > 5000000) {
        echo "
            <script>
                alert('Ukuran file terlalu besar!')
                window.location='tambahProduk.php'
            </script>
        ";
        $upload_berhasil = 0;
    }
    // Mengizinkan file dengan format tertentu
    if ($tipe_file != "png" && $tipe_file != "jpeg" && $tipe_file != "jpg") {
        echo "
            <script>
                alert('File tidak di izinkan!')
                window.location='tambahProduk.php'
            </script>
        ";
        $upload_berhasil = 0;
    }
    // Cek apakah $upload_berhasil nilainya 0 dan menampilkan pesan kesalahan
    if ($upload_berhasil == 0) {
        echo "
            <script>
                alert('File tidak bisa diupload!')
                window.location='tambahProduk.php'
            </script>
        ";
        // Jika $upload_berhasil = 1 maka coba upload file
    } else {
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            $query = mysqli_query($koneksi, "INSERT INTO produk (id_produk, nama_produk, slug, id_kategori, harga, kondisi, berat, deskripsi, gambar) 
            VALUES ('','$nama_produk','$slug' ,'$id_kategori','$harga','$kondisi','$berat','$deskripsi','$gambar')");
            if ($query) {
                return mysqli_affected_rows($koneksi);
            } else {
                echo "Gagal Simpan";
            }
        } else {
            echo "Upload file gagal";
        }
    }
}

// Edit Produk
function editProduk($data)
{
    global $koneksi;

    $id_produk = htmlspecialchars($data["id_produk"]);
    $nama_produk = htmlspecialchars($data["nama_produk"]);
    $slug = htmlspecialchars($data["slug"]);
    $id_kategori = htmlspecialchars($data["id_kategori"]);
    $harga = htmlspecialchars($data["harga"]);
    $kondisi = htmlspecialchars($data["kondisi"]);
    $berat = htmlspecialchars($data["berat"]);
    $deskripsi = $data["deskripsi"];

    if ($nama_produk == "" || $slug == "" || $id_kategori == "" || $harga == "" || $kondisi == "" || $berat == "" || $deskripsi == "") {
        echo "
            <script>
                alert('Lengkapi semua data!')
            </script>
        ";
        return;
    }

    $target_dir = "../../fileUpload/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    $ukuran_file = $_FILES["gambar"]["size"];
    $tipe_file = $_FILES["gambar"]["type"];
    $upload_berhasil = 1;
    $tipe_file = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $gambarBaru = basename($_FILES["gambar"]["name"]);
    $gambarLama = $data["gambar_lama"];

    if ($gambarBaru != '') {
        $updateGambar = basename($_FILES["gambar"]["name"]);
    } else {
        $updateGambar = $gambarLama;
    }

    if ($_FILES["gambar"]["name"] != '') {
        if (file_exists($target_file)) {
            echo "
                <script>
                    alert('File sudah ada, ganti nama gambar!')
                    window.location='index.php'
                </script>
            ";
            $upload_berhasil = 0;
        }
    }
    if ($tipe_file != "png" && $tipe_file != "jpeg" && $tipe_file != "jpg" && $tipe_file != "") {
        echo "
            <script>
                alert('File tidak di izinkan!')
                window.location='tambahProduk.php'
            </script>
        ";
        $upload_berhasil = 0;
    }

    if ($ukuran_file > 5000000) {
        echo "
            <script>
                alert('Ukuran file terlalu besar!')
                window.location='index.php'
            </script>
        ";
        $upload_berhasil = 0;
    }
    if ($upload_berhasil == 0) {
        echo "
            <script>
                alert('File tidak bisa diupload!')
                window.location='index.php'
            </script>
        ";
        // Jika $upload_berhasil = 1 maka coba upload file
    } else {
        $simpan = mysqli_query($koneksi, "UPDATE produk SET id_produk='$id_produk', nama_produk='$nama_produk', id_kategori='$id_kategori', harga='$harga', kondisi='$kondisi', berat='$berat',  deskripsi='$deskripsi', gambar='$updateGambar' WHERE slug = '$slug'");
        if ($simpan) {
            if ($_FILES["gambar"]["name"] != '') {
                move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
                unlink($target_dir . $gambarLama);
            }
            return mysqli_affected_rows($koneksi);
        } else {
            echo "Gagal update!";
        }
    }
}
// Hapus Produk
function deleteProduk($slug)
{
    global $koneksi;
    $produk = mysqli_query($koneksi, "SELECT * FROM produk WHERE slug = '$slug'");
    $data = mysqli_fetch_array($produk);

    $hapus = mysqli_query($koneksi, "DELETE FROM produk WHERE slug = '$slug'");
    if ($hapus) {
        unlink("../../fileUpload/$data[gambar]");
        return mysqli_affected_rows($koneksi);
    }
}

// Tambah Kategori
function addKategori($data)
{
    global $koneksi;

    $nama_kategori = htmlspecialchars($data["nama_kategori"]);
    $icon_kategori = htmlspecialchars($data["icon_kategori"]);
    if ($nama_kategori == "" ||  $icon_kategori  ==  "") {
        echo "
            <script>
                alert('semua form harus di isi!')
            </script>
        ";
        return;
    }
    $query = "INSERT INTO kategori (id_kategori, nama_kategori, icon_kategori) VALUES ('','$nama_kategori', '$icon_kategori')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// Edit Kategori
function editKategori($data)
{
    global $koneksi;

    $id_kategori = htmlspecialchars($data["id_kategori"]);
    $nama_kategori = htmlspecialchars($data["nama_kategori"]);
    $icon_kategori = htmlspecialchars($data["icon_kategori"]);

    $query = "UPDATE kategori SET nama_kategori = '$nama_kategori', icon_kategori = '$icon_kategori' WHERE id_kategori = '$id_kategori'";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// Hapus Kategori
function deleteKategori($id_kategori)
{
    global $koneksi;
    $query = "DELETE FROM kategori WHERE id_kategori = '$id_kategori'";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}
// Tambah Keranjang
function tambah_keranjang($data)
{
    global $koneksi;

    $id_produk = htmlspecialchars($data["id_produk"]);
    $id_user = htmlspecialchars($data["id_user"]);
    $jumlah_produk = htmlspecialchars($data["jumlah_produk"]);
    $harga_produk = htmlspecialchars($data["harga_produk"]);

    $query = mysqli_query($koneksi, "INSERT INTO keranjang (id_keranjang, id_produk, id_user, jumlah_produk, harga_produk) VALUES ('', '$id_produk','$id_user','$jumlah_produk','$harga_produk')");

    if ($query) {
        return mysqli_affected_rows($koneksi);
    }
}

// Hapus Keranjang
function deleteKeranjang($data)
{
    global $koneksi;

    $id_keranjang = $data["id_keranjang"];
    $id_user = $data["id_user"];

    $query =  mysqli_query($koneksi, "DELETE FROM keranjang WHERE id_keranjang = '$id_keranjang' AND id_user = '$id_user'");
    if ($query) {
        return mysqli_affected_rows($koneksi);
    }
}
function formatKeRupiah($angka)
{
    $hasi_rupiah = number_format($angka, 2, ',', '.');
    return  $hasi_rupiah;
}
