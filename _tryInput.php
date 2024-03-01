<?php
include '_connDb.php';
$conn = connectDatabase();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil tanggal, gambar, dan jumlah dari formulir
    $tanggal = $_POST['tanggal'];
    $gambar = $_FILES['gambar']['name'];
    $tmp_gambar = $_FILES['gambar']['tmp_name'];
    $jenis = $_POST['jenis'];
    $jumlah = $_POST['jumlah'];

    // Direktori penyimpanan gambar
    $upload_dir = "D:/Zidni Zidan/Documents/KAMPUS/Tante/kirimdata/";

    // Pindahkan gambar ke direktori penyimpanan
    move_uploaded_file($tmp_gambar, $upload_dir . $gambar);

    // Query untuk memasukkan data ke tabel
    $sql = "INSERT INTO data_pelanggaran (tanggal, gambar, jenis,  jumlah) VALUES ('$tanggal', '$gambar', '$jenis', '$jumlah')";

    // Eksekusi query
    mysqli_query($conn, $sql);

    // Redirect ke halaman utama
    header("location: _tryInput.php");
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

        <label>Jenis kendaraan:</label>
        <input type="text" name="jenis">
        
        <input type="submit" name="simpan" value="Simpan">
    </form>
</body>

</html>
