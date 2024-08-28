<?php
include 'koneksi.php';

if (isset($_POST['nisn'])) {
    $nisn = $_POST['nisn'];
    $mata_pelajaran = $_POST['mata_pelajaran'];
    $nilai_harian = $_POST['nilai_harian'];
    $nilai_pat = $_POST['nilai_pat'];
    $nilai_pas = $_POST['nilai_pas'];
    $nilai_akhir = $_POST['nilai_akhir'];
    $keterangan = $_POST['keterangan'];
    $catatan_walikelas = $_POST['catatan_walikelas']; 

    
    if (is_array($mata_pelajaran) && is_array($nilai_harian) && is_array($nilai_pat) && is_array($nilai_pas) && is_array($nilai_akhir) && is_array($keterangan)) {
       
        $query = "UPDATE tbl_input_nilai 
                  SET nilai_harian = ?, 
                      nilai_pat = ?, 
                      nilai_pas = ?, 
                      nilai_akhir = ?, 
                      rata_rata = ?, 
                      keterangan = ?, 
                      catatan_walikelas = ? 
                  WHERE nisn = ? AND mata_pelajaran = ?";
        
      
        $stmt = $koneksi->prepare($query);

        if ($stmt === false) {
            die('Prepare failed: ' . $koneksi->error);
        }

        
        $stmt->bind_param("ddddssss", 
            $nilai_harian_param, 
            $nilai_pat_param, 
            $nilai_pas_param, 
            $nilai_akhir_param, 
            $rata_rata_param,
            $keterangan_param, 
            $catatan_walikelas, 
            $nisn_param,
            $mata_pelajaran_param
        );

        for ($i = 0; $i < count($mata_pelajaran); $i++) {
            $nilai_harian_param = $nilai_harian[$i];
            $nilai_pat_param = $nilai_pat[$i];
            $nilai_pas_param = $nilai_pas[$i];
            $nilai_akhir_param = $nilai_akhir[$i];
            $keterangan_param = $keterangan[$i];
            $mata_pelajaran_param = $mata_pelajaran[$i];
            $nisn_param = $nisn; 

           
            $rata_rata_param = (
                $nilai_harian_param + 
                $nilai_pat_param + 
                $nilai_pas_param + 
                $nilai_akhir_param
            ) / 4;

           
            if (!$stmt->execute()) {
                echo "Terjadi kesalahan: " . $stmt->error;
                exit();
            }
        }

        header("Location: data_siswa.php?message=Data berhasil diperbarui");
        exit(); 

       
        $stmt->close();
    } else {
        echo "Data nilai tidak valid.";
    }
} else {
    echo "NISN tidak ditemukan.";
}

$koneksi->close();
?>
