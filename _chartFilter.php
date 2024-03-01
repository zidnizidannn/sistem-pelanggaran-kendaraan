<?php
include '_connDb.php';
$conn = connectDatabase();

$date = $_GET['date'];
$month = $_GET['month'];
$year = $_GET['year'];

$sql = "SELECT DATE_FORMAT(tanggal,'%d %M %Y') AS tanggal, COUNT(*) AS jumlah 
        FROM data_pelanggaran 
        WHERE DATE_FORMAT(tanggal,'%d %M %Y') = '$date $month $year' 
        GROUP BY tanggal";

$result = $conn->query($sql);

$labels = [];
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $labels[] = $row['tanggal'];
    $data[] = $row['jumlah'];
}

header('Content-Type: application/json');
echo json_encode(['labels' => $labels, 'data' => $data]);
