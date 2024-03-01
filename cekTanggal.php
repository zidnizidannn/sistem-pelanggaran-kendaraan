<?php
include '_connDb.php';
$conn= connectDatabase();

$tanggal = $_POST['tanggal'];
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];

// Buat query untuk cek tanggal 
$query = "SELECT * FROM data_pelanggaran 
            WHERE DAY(tanggal) = $tanggal  
            AND MONTH(tanggal) = $bulan
            AND YEAR(tanggal) = $tahun";

// Jalankan query
$result = mysqli_query($conn, $query);

// Hitung jumlah data tanggal tsb
$count = mysqli_num_rows($result);

// Cek apakah ada data tsb di database
if ($count > 0) {
    // Jika ada, kirim response 1
    echo "1";
} else {
    // Jika tidak ada, kirim response 0
    echo "0";
}
