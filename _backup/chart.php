<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/bootstrap.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="assets/bootstrap.bundle.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
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
                $result = mysqli_query($conn, "SELECT tanggal, jumlah FROM datapelanggaran");

                // Siapkan data untuk chart
                $labels = [];
                $data = [];

                while ($row = mysqli_fetch_array($result)) {
                    $labels[] = $row['tanggal'];
                    $data[] = $row['jumlah'];
                }

                echo implode(", ", $labels);
                echo implode(", ", $data);
                ?>

                <canvas class="" id="myChart" style="max-width:80%; background-color:white;"></canvas>

                <script>
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: <?php echo json_encode($labels); ?>,
                            datasets: [{
                                label: 'Jumlah Pelanggaran',
                                data: <?php echo json_encode($data); ?>,
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
                </script>
            </div>
        </div>
    </div>
    <script src="/js/home.js"></script>
</body>

</html>