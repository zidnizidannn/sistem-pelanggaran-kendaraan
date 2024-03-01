<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/bootstrap.css">
    <link rel="stylesheet" href="/css/global.css">
    <!-- <link rel="stylesheet" href="css/home.css"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script src="assets/bootstrap.bundle.min.js"></script>

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

    <!-- ====================== -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script> -->
    <style>
        /* *{
            border: 1px solid red;
        } */
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

        .gambar {
            width: 150px;
        }

        .sidebar .menu #table {
            background-color: #0087CC;
            color: white;
        }
    </style>
</head>

<body class="">
    <div class="container1 d-flex">
        <!-- SIDEBAR -->
        <?php include 'layout/sidebar.html' ?>

        <!-- CONTENT -->
        <div class="main-content">

            <!-- header -->
            <?php include 'layout/header.html' ?>

            
            <div class="content d-flex flex-column justify-content-center align-items-center mt-3">
                <div class="h3 header" style="font-size: 2rem; margin: 1rem 0rem;">Pelanggaran Tertangkap Pada Jalan Kapuas</div>
                <div class="h3 header-print" style="font-size: 2rem; margin: 1rem 0rem; font-family: 'Times New Roman', Times, serif; font-weight: bold; display:none; ">Data Pelanggaran Larangan Masuk Bagi Kendaraan Roda Empat atau Lebih</div>

                <!-- filter -->
                <div class="dropdown align-self-start" style="padding-left: 5%;">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        filter
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Per hari</a></li>
                        <li><a class="dropdown-item" href="#">Per minggu</a></li>
                        <li><a class="dropdown-item" href="#">Per bulan</a></li>
                    </ul>
                </div>

                <!-- tabel -->
                <div class="" style="width: 90%">
                    <?php
                    include '_connDb.php';
                    $conn = connectDatabase();

                    $sql = "SELECT
                    no,
                DATE_FORMAT(tanggal, '%H:%i') AS jam, 
                DAY(tanggal) AS tanggal, 
                MONTH(tanggal) as bulan, 
                YEAR(tanggal) as tahun,
                gambar, jenis, jumlah
            FROM data_pelanggaran";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<table class='table table-striped' id='example'>
                <thead class='head'>
                    <tr>
                        <th scope='col'>No</th>
                        <th scope='col'>Jam</th>
                        <th scope='col'>Tanggal</th>
                        <th scope='col'>Bulan</th>
                        <th scope='col'>Tahun</th>
                        <th scope='col'>Gambar</th>
                        <th scope='col'>Jenis</th>
                        <th scope='col'>Jumlah</th>
                    </tr>
                </thead>
                <tbody>";

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                    <td>" . $row['no'] . "</td>
                    <td>" . $row['jam'] . "</td>
                    <td>" . $row['tanggal'] . "</td>
                    <td>" . $row['bulan'] . "</td>
                    <td>" . $row['tahun'] . "</td>
                    <td><img class='gambar' src='kirimdata/" .($row['gambar']) . "' alt='Gambar'></td>
                    <td>" . $row['jenis'] . "</td>
                    <td>" . $row['jumlah'] . "</td>
                </tr>";
                        }
                        echo "</tbody></table>";
                    } else {
                        echo "Tidak ada data.";
                    }

                    closeDatabase($conn);
                    ?>

                </div>
            </div>
        </div>
    </div>
    <script src="/js/sidebar.js"></script>
    <script src="/js/table.js"></script>
</body>

</html>