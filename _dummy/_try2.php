<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/bootstrap.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script src="assets/bootstrap.bundle.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <style>
        .sidebar .menu #chart {
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

            <div class="content d-flex flex-column justify-content-center align-items-center" style="">

                <!-- chart -->
                <?php
                include '_connDb.php';
                $conn = connectDatabase();

                function hari($conn)
                {
                    $result = mysqli_query($conn, "SELECT tanggal, jumlah FROM datapelanggaran");

                    // Siapkan data untuk chart
                    $labels = [];
                    $data = [];

                    while ($row = mysqli_fetch_array($result)) {
                        $labels[] = $row['tanggal'];
                        $data[] = $row['jumlah'];
                    }

                    return ['labels' => $labels, 'data' => $data];
                }

                function minggu($conn)
                {
                    $sql = "SELECT WEEK(tanggal) AS minggu, COUNT(*) AS jumlah FROM data_pelanggaran GROUP BY minggu";
                    $result = $conn->query($sql);

                    // Siapkan data untuk chart
                    $labels = [];
                    $data = [];

                    while ($row = mysqli_fetch_assoc($result)) {
                        $labels[] = $row['minggu'];
                        $data[] = $row['jumlah'];
                    }

                    return ['labels' => $labels, 'data' => $data];
                }

                function bulan($conn)
                {
                    $sql = "SELECT MONTH(tanggal) AS bulan, YEAR(tanggal) AS tahun, COUNT(*) AS jumlah FROM data_pelanggaran GROUP BY bulan, tahun";
                    $result = $conn->query($sql);

                    // Siapkan data untuk chart
                    $labels = [];
                    $data = [];

                    while ($row = mysqli_fetch_assoc($result)) {
                        $labels[] = $row['bulan'];
                        $data[] = $row['jumlah'];
                    }

                    return ['labels' => $labels, 'data' => $data];
                }
                ?>

                <div class="h3" style="font-size: 2rem; margin: 1rem 0rem;">Grafik Pelanggaran</div>

                <!-- filter -->
                <<div class="dropdown align-self-start" id="filterDropdown" style="padding-left: 10%;">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        filter
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Per Hari</a></li>
                        <li><a class="dropdown-item" href="#">Per Minggu</a></li>
                        <li><a class="dropdown-item" href="#">Per Bulan</a></li>
                    </ul>
            </div>

            <!-- grafik -->
            <canvas class="" id="myChart" style="max-width:80%; background-color:white;"></canvas>
        </div>
    </div>
    </div>
    <script src="/js/home.js"></script>
    <script>
        // Fungsi untuk mengambil data pelanggaran berdasarkan filter
        function fetchData(filter) {
            <?php
            $dataPerHari = json_encode(hari($conn));
            $dataPerMinggu = json_encode(minggu($conn));
            $dataPerBulan = json_encode(bulan($conn));
            ?>
            switch (filter) {
                case 'Per Hari':
                    return <?php echo $dataPerHari; ?>;
                case 'Per Minggu':
                    return <?php echo $dataPerMinggu; ?>;
                case 'Per Bulan':
                    return <?php echo $dataPerBulan; ?>;
                default:
                    return <?php echo $dataPerHari; ?>;
            }
        }

        // Inisialisasi data yang aktif
        var activeData = fetchData('Per Hari');

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: activeData.labels,
                datasets: [{
                    label: `Jumlah Pelanggaran per ${activeData.label}`, // Label sesuai dengan filter awal
                    data: activeData.data,
                    backgroundColor: 'rgba(52, 119, 235, 0.2)',
                    borderColor: 'rgba(52, 119, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        // Event listener pada dropdown
        const dropdown = document.getElementById('filterDropdown');
        dropdown.addEventListener('click', function(event) {
            const selectedFilter = event.target.innerText;

            // Ganti data yang aktif berdasarkan pilihan dropdown
            activeData = fetchData(selectedFilter);

            // Perbarui label grafik sesuai dengan pilihan dropdown
            myChart.data.datasets[0].label = `Jumlah Pelanggaran per ${selectedFilter}`;

            // Perbarui grafik
            myChart.data.labels = activeData.labels;
            myChart.data.datasets[0].data = activeData.data;
            myChart.update();
        });
    </script>
</body>

</html>