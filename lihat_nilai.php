<?php
include 'koneksi.php';

try {
    // Mengambil data dari tabel
    $query = "SELECT id, nisn, nama, kelas, jurusan, nama_sekolah, alamat_sekolah, tahun_ajaran, mata_pelajaran, nilai_harian, nilai_pat, nilai_pas, nilai_akhir, keterangan FROM tbl_nilai ORDER BY nisn";

    $result = $koneksi->query($query);
    
    if (!$result) {
        throw new Exception("Error fetching data: " . $koneksi->error);
    }
} catch (Exception $e) {
    echo "Terjadi kesalahan: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Laporan Nilai</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon">
                    <img src="pgr.webp" alt="Logo" style="width: 60px; height: 60px;">
                </div>
                <div class="sidebar-brand-text mx-3">APLIKASI DATA NILAI</div>
            </a>
            <li class="nav-item">
                <a class="nav-link" href="laporan.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                        <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1"/>
                    </svg>
                    <span>Kembali</span>
                </a>
            </li>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Navbar Content Here -->
                </nav>
                <div class="container-fluid">
                <h4 class="h1 mb-0 text-gray-800 fade-in" style="font-family: Arial, sans-serif; font-size: 40px; font-weight: bold; color: #333;">LAPORAN NILAI SISWA</h4>
                    <p>SMK PGRI 1 CIMAHI</p>
                    <?php
                    $current_nisn = "";
                    $edit_button_shown = false;
                    $totalNilaiAkhir = 0;
                    $countMataPelajaran = 0;

                while ($row = $result->fetch_assoc()) {
                    if ($current_nisn !== $row['nisn']) {
        if ($current_nisn !== "") {
            echo "<tfoot>";
            echo "<tr><td colspan='4'><strong>Rata-rata Nilai</strong></td>";
            echo "<td><strong>" . number_format($totalNilaiAkhir / $countMataPelajaran, 2) . "</strong></td></tr>";
            echo "</tfoot></tbody></table>";
        }
        $current_nisn = $row['nisn'];
        $edit_button_shown = false; // Reset tombol edit
        $totalNilaiAkhir = 0;
        $countMataPelajaran = 0;

        // Display student info
        echo "<div class='student-info'>";
        echo "<h5>NISN: " . htmlspecialchars($row['nisn']) . "</h5>";
        echo "<p>Nama: " . htmlspecialchars($row['nama']) . "</p>";
        echo "<p>Kelas: " . htmlspecialchars($row['kelas']) . "</p>";
        echo "<p>Jurusan: " . htmlspecialchars($row['jurusan']) . "</p>";
        echo "<p>Nama Sekolah: " . htmlspecialchars($row['nama_sekolah']) . "</p>";
        echo "<p>Alamat Sekolah: " . htmlspecialchars($row['alamat_sekolah']) . "</p>";
        echo "<p>Tahun Ajaran: " . htmlspecialchars($row['tahun_ajaran']) . "</p>";
        echo "</div>";

        // Start a new table for the current student
        echo "<table class='table table-bordered' width='100%' cellspacing='0'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Mata Pelajaran</th>";
        echo "<th>Nilai Harian</th>";
        echo "<th>Nilai PAT</th>";
        echo "<th>Nilai PAS</th>";
        echo "<th>Nilai Akhir</th>";
        echo "<th>Keterangan</th>";
        echo "<th>Aksi</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
    }

        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['mata_pelajaran']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nilai_harian']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nilai_pat']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nilai_pas']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nilai_akhir']) . "</td>";
        echo "<td>" . htmlspecialchars($row['keterangan']) . "</td>";
        echo "<td>";

        if (!$edit_button_shown) {
        echo "<a href='edit.php?nisn=" . htmlspecialchars($row["nisn"]) . "' class='btn btn-warning btn-sm'>Edit</a>";
        $edit_button_shown = true; 
    }

    echo "</td>";
    echo "</tr>";

  
    $totalNilaiAkhir += (float)$row['nilai_akhir'];
    $countMataPelajaran++;
}

if ($current_nisn !== "") {
    echo "<tfoot>";
    echo "<tr><td colspan='4'><strong>Rata-rata Nilai</strong></td>";
    echo "<td><strong>" . number_format($totalNilaiAkhir / $countMataPelajaran, 2) . "</strong></td></tr>";
    echo "</tfoot></tbody></table>";
}
?>
 </div>
</div>
</div>
</div>
</body>
</html>
