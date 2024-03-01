<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/bootstrap.css">
    <script src="assets/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"> -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <!-- DataTables CSS and JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <!-- DataTables Buttons CSS and JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>

    <!-- JSZip -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <!-- PDFMake -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <!-- DataTables Buttons Extensions -->
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            background-color: white;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 1rem 0rem;
            text-align: center;
        }

        .head {
            background-color: #ddd;
        }

        .gambar{
            width: 150px;
        }
    </style>
</head>

<body class="">
    <div class="container1 d-flex">
        <!-- SIDEBAR -->
        <div class="sidebar sidebar-collapse d-flex flex-column p-1">
            <div class="header">
                <div class="list-item d-flex align-item-center p-1 m-1">
                    <a href="">
                        <img src="material/Logo Politeknik Negeri Madiun.png" alt="" style="width: 6rem;">
                        <div class="d-flex flex-column">
                            <span class="description-header" style="font-size: 2rem;">POLITEKNIK</span>
                            <span class="description-header" style="color: white; font-size: 1.4rem; margin-top: -0.6rem;">NEGERI MADIUN</span>
                        </div>
                    </a>
                </div>
            </div>
            <!-- MENU -->
            <div class="menu">
                <div class="list-item">
                    <a href="table.html">
                        <i class="material-symbols-outlined">description</i>
                        <div class="description">Data Pelanggaran</div>
                    </a>
                </div>
                <div class="list-item">
                    <i class="material-symbols-outlined">monitoring</i>
                    <div class="description">Grafik Pelanggaran</div>
                </div>
                <div class="list-item">
                    <i class="material-symbols-outlined">print</i>
                    <div class="description">Cetak Data</div>
                </div>
            </div>
            <!-- BUTTON LOGOUT -->
            <div class="d-flex align-items-center justify-content-center mt-auto">
                <a href="#" class="btn rounded-3" style="height: 3rem; margin-bottom: 1rem;">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="description">logout</span>
                </a>
            </div>
        </div>
        <!-- CONTENT -->
        <div class="main-content">
            <header class="header d-flex justify-content-between align-items-center p-3" style="background-color: white;">
                <div class="header-left d-flex align-items-center">
                    <span class="btn material-symbols-outlined">menu</span>
                    <h3 class="header-title mb-0">Sistem Informasi Data Larangan Masuk Bagi Kendaraan Roda 4</h3>
                </div>
                <div class="header-right d-flex align-items-center">
                    <span class="material-symbols-outlined me-3" style="font-size: 2rem;">notifications</span>
                    <span class="username mr-3">Arina Mustika</span>
                    <span class="material-symbols-outlined ms-3 " style="font-size: 2rem;">account_circle</span>
                </div>
            </header>
            <div class="content d-flex flex-column justify-content-center align-items-center mt-5">
                <div style="width: 90%">
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "sistemparkir";

                    $conn = mysqli_connect($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Koneksi gagal: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM datapelanggaran";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<table class='table table-striped' id='example'>
                            <thead class='head'>
                                <tr>
                                <th scope='col' style='width: 5%'>No</th>
                                <th scope='col' style='width: 25%'>Tanggal</th>
                                <th scope='col' style='width: 60%'>Gambar</th>
                                <th scope='col' style='width: 10%'>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>";

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <th scope='row'>" . $row['no'] . "</th>
                                <td>" . $row['tanggal'] . "</td>
                                <td><img class='gambar' src='kirimdata/" .($row['gambar']) . "' alt='Gambar'></td>
                                <td>" . $row['jumlah'] . "</td>
                            </tr>";
                        }

                        echo "</tbody></table>";
                    } else {
                        echo "Tidak ada data.";
                    }

                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/home.js"></script>
</body>
</html>