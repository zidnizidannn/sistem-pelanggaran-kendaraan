<?php
include '_connDb.php';
$conn = connectDatabase();
$m = sprintf('%02d', $_GET['m']);
$y = $_GET['y'];
$query = "SELECT cast(tanggal as date) as tgl, sum(jumlah) as jumlah FROM `data_pelanggaran` GROUP BY tgl";
$result = mysqli_query($conn, $query);

// Siapkan data untuk chart
$labels = [];
$data = [];

while ($row = mysqli_fetch_array($result)) {
    $labels[] = $row['tgl'];
    $data[] = $row['jumlah'];
}

echo json_encode([
    'labels' => $labels,
    'data' => $data,
]);