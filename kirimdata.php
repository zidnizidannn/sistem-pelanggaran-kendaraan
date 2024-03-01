<?php
include '_connDb.php';
$conn = connectDatabase();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil tanggal, gambar, dan jumlah dari formulir
    $tanggal = $_POST['tanggal'];
    $gambar = $_FILES['gambar']['name'];
    $tmp_gambar = $_FILES['gambar']['tmp_name'];
    $jumlah = $_POST['jumlah'];

    // Direktori penyimpanan gambar
    $upload_dir = "D:/Zidni Zidan/Documents/KAMPUS/Tante/kirimdata/";

    // Pindahkan gambar ke direktori penyimpanan
    move_uploaded_file($tmp_gambar, $upload_dir . $gambar);

    // Ambil minggu dan tahun dari tanggal
    $per_minggu = date('Y-m-W', strtotime($tanggal));

    // Query untuk memasukkan data ke tabel
    $sql = "INSERT INTO datapelanggaran (tanggal, per_minggu, gambar, jumlah) VALUES ('$tanggal', '$per_minggu', '$gambar', $jumlah)";

    // Eksekusi query
    mysqli_query($conn, $sql);

    // Redirect ke halaman utama
    header("location: kirimdata.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form class="form bg-black" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <label>Tanggal Pelanggaran:</label>
        <input type="datetime-local" name="tanggal">
        <label>Gambar Pelanggaran:</label>
        <input type="file" name="gambar">
        <label>Jumlah Pelanggaran:</label>
        <input type="number" name="jumlah">
        <input type="submit" name="simpan" value="Simpan">
    </form>
</body>

</html>
