<?php
session_start();

$nisn = $_POST['nisn'];
$nama = $_POST['nama'];

include 'koneksi.php';

$query_validasi = mysqli_query($koneksi, "SELECT * FROM register WHERE nisn = '$nisn' AND nama = '$nama'");

if (mysqli_num_rows($query_validasi) == 0) {
    ?>
    <script>
        alert("Maaf NISN/NIP atau Nama yang dimasukkan tidak sesuai.");
        window.location.assign('login.php');
    </script>
    <?php
} else {
    $data = mysqli_fetch_assoc($query_validasi);

    $_SESSION["nisn"] = $nisn;
    $_SESSION["nama"] = $nama;

    if ($status == 'guru') {
        header("Location: guru.php");
        exit(); 
    } elseif ($status == 'siswa') {
        header("Location: index.php");
        exit(); 
    } else {
       
        ?>
        <script>
            alert("Status tidak valid.");
            window.location.assign('login.php');
        </script>
        <?php
    }
}
?>
