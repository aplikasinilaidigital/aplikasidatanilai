<?php
$nisn = $_POST['nisn'];
$nama = $_POST['nama'];

if (strlen($nisn) == 18) {
    $status = 'guru';
} elseif (strlen($nisn) == 10) {
    $status = 'siswa';
} else {
    ?>
    <script>
        alert("NISN harus memiliki 10 atau 18 karakter!");
        window.location.assign('register.php');
    </script>
    <?php
    exit;
}

if (empty($nisn) || empty($nama)) {
    ?>
    <script>
        alert("Harap lengkapi semua data!");
        window.location.assign('register.php');
    </script>
    <?php
    exit;
}

include 'koneksi.php';

$query_validasi = mysqli_query($koneksi, "SELECT * FROM register WHERE nisn = '$nisn'");

if (mysqli_num_rows($query_validasi) == 0) {
    $query = mysqli_query($koneksi, "INSERT INTO register(nisn,nama,status) VALUES('$nisn','$nama', '$status')");
    ?>
    <script>
        alert("Data sudah ditambahkan, Silahkan login");
        window.location.assign('login.php');
    </script>
    <?php
} else {
    ?>
    <script>
        alert("Data sudah ada !");
        window.location.assign('register.php');
    </script>
    <?php
}
?>
