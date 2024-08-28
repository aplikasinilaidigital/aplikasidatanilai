<?php
include 'koneksi.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    $nama_sekolah = $_POST['nama_sekolah'];
    $alamat_sekolah = $_POST['alamat_sekolah'];
    $tahun_ajaran = $_POST['tahun_ajaran'];
    $mata_pelajaran = $_POST['mata_pelajaran'];
    $nilai_harian = $_POST['nilai_harian'];
    $nilai_pat = $_POST['nilai_pat'];
    $nilai_pas = $_POST['nilai_pas'];
    $keterangan = $_POST['keterangan'];
    $catatan_walikelas = $_POST['catatan_walikelas'];

    
    $koneksi->begin_transaction();

    try {
       
        $count = count($mata_pelajaran);
        if (count($nilai_harian) != $count || count($nilai_pat) != $count || count($nilai_pas) != $count || count($keterangan) != $count) {
            throw new Exception('Jumlah data tidak konsisten.');
        }

        $totalNilaiAkhir = 0;
        $sql = "INSERT INTO tbl_nilai (
                    nisn, nama, kelas, jurusan, nama_sekolah, alamat_sekolah, tahun_ajaran, mata_pelajaran,
                    nilai_harian, nilai_pat, nilai_pas, nilai_akhir, keterangan, catatan_walikelas
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE 
                    nama = VALUES(nama),
                    kelas = VALUES(kelas),
                    jurusan = VALUES(jurusan),
                    nama_sekolah = VALUES(nama_sekolah),
                    alamat_sekolah = VALUES(alamat_sekolah),
                    tahun_ajaran = VALUES(tahun_ajaran),
                    nilai_harian = VALUES(nilai_harian),
                    nilai_pat = VALUES(nilai_pat),
                    nilai_pas = VALUES(nilai_pas),
                    nilai_akhir = VALUES(nilai_akhir),
                    keterangan = VALUES(keterangan),
                    catatan_walikelas = VALUES(catatan_walikelas)";

        if ($stmt = $koneksi->prepare($sql)) {
            for ($index = 0; $index < $count; $index++) {
                $nilaiHarian = (float)$nilai_harian[$index];
                $nilaiPAT = (float)$nilai_pat[$index];
                $nilaiPAS = (float)$nilai_pas[$index];

                $nilai_akhir = ($nilaiHarian * 0.3) + ($nilaiPAT * 0.3) + ($nilaiPAS * 0.4); // Hitung nilai akhir

                $totalNilaiAkhir += $nilai_akhir;

                $stmt->bind_param(
                    "ssssssssssssss", 
                    $nisn, 
                    $nama, 
                    $kelas,
                    $jurusan,
                    $nama_sekolah,
                    $alamat_sekolah,
                    $tahun_ajaran,
                    $mata_pelajaran[$index], 
                    $nilaiHarian, 
                    $nilaiPAT, 
                    $nilaiPAS, 
                    $nilai_akhir, 
                    $keterangan[$index],
                    $catatan_walikelas
                );

                if (!$stmt->execute()) {
                    throw new Exception("Execute failed: " . $stmt->error);
                }
            }
            $stmt->close();

            $rata_rata = $count > 0 ? $totalNilaiAkhir / $count : 0;


        } else {
            throw new Exception('Prepare failed: ' . htmlspecialchars($koneksi->error));
        }

        $koneksi->commit();
        header('Location: laporan.php');
        exit;

    } catch (Exception $e) {
        
        $koneksi->rollback();
        echo "Gagal menambahkan data: " . $e->getMessage();
    }

 
    $koneksi->close();
}
?>
