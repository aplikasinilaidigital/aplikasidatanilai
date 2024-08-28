<?php
include ('koneksi.php');

$nip = $_POST['nip'];
$nama = $_POST['nama'];
$mata_pelajaran = $_POST['mata_pelajaran'];

// Lakukan query UPDATE dengan nilai yang sudah divalidasi
$query = "UPDATE tbl_guru_pelajaran SET nama = '$nama', mata_pelajaran = '$mata_pelajaran' WHERE nip = '$nip'";

if ($koneksi->query($query) === TRUE) {
    header('Location: guru_pelajaran.php');
} else {
    echo "Error: " . $query . "<br>" . $koneksi->error;
}

$koneksi->close();
?>
