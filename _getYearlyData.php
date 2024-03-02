<?php
include '_connDb.php';
$conn = connectDatabase();
$y = $_GET['y'];
$query = "SELECT cast(tanggal as char(7)) as tgl, sum(jumlah) as jumlah FROM `data_pelanggaran` GROUP BY tgl";
$result = mysqli_query($conn, $query);

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