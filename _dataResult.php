<?php
include '_connDb.php';
$conn = connectDatabase();

// Fetch data from the 'datapelanggaran' table
$sql = "SELECT tanggal, jumlah FROM datapelanggaran";
$result = $conn->query($sql);

// Convert result set to JSON
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

// Close the database connection
closeDatabase($conn);
?>
