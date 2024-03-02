<?php
include '_connDb.php';
$conn = connectDatabase();
$d = sprintf('%02d', $_GET['d']);
$m = sprintf('%02d', $_GET['m']);
$y = $_GET['y'];
$query = "SELECT tanggal, jumlah FROM `data_pelanggaran` WHERE cast(tanggal as date) = '$y-$m-$d'";
$result = mysqli_query($conn, $query);

// Siapkan data untuk chart
$labels = [];
$data = [];

while ($row = mysqli_fetch_array($result)) {
    $labels[] = $row['tanggal'];
    $data[] = $row['jumlah'];
}

echo json_encode([
    'labels' => $labels,
    'data' => $data,
]);