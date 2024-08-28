<?php
include('koneksi.php');

$old_nip = $_POST['old_nip'];
$nip = $_POST['nip'];
$nama = $_POST['nama'];
$walikelas = $_POST['walikelas'];
$mata_pelajaran = $_POST['mata_pelajaran'];


if (empty($nip) || empty($nama) || empty($walikelas) || empty($mata_pelajaran)) {
    echo "Semua field harus diisi!";
    exit;
}


$query = "UPDATE tbl_walikelas 
          SET nip = ?, nama = ?, walikelas = ?, mata_pelajaran = ?
          WHERE nip = ?";


$stmt = $koneksi->prepare($query);


if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($koneksi->error));
}


$stmt->bind_param("sssss", $nip, $nama, $walikelas, $mata_pelajaran, $old_nip);


if ($stmt->execute()) {
   
    header("Location: data_guru.php");
    exit();
} else {
    echo "Error: " . htmlspecialchars($stmt->error);
}

$stmt->close();
$koneksi->close();
?>
