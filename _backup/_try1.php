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
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
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
                <!-- CHART -->
                <div class="h3" style="font-size: 2rem; margin: 1rem 0rem;">Grafik Pelanggaran</div>

                <!-- filter -->
                <div class="dropdown align-self-start " style="padding-left: 10%;">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        filter
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#" data-filter="harian">Per Hari</a></li>
                        <li><a class="dropdown-item" href="#" data-filter="mingguan">Per Minggu</a></li>
                        <li><a class="dropdown-item" href="#" data-filter="bulanan">Per Bulan</a></li>
                    </ul>
                </div>

                <!-- grafik -->
                <canvas class="" id="myChart" style="max-width:75%; max-height:85% ;background-color:white;"></canvas>
            </div>
        </div>
    </div>
    
    <script src="/js/home.js"></script>
    <script>
        var myChart;
        function drawChart(labels, data, label) {
            var ctx = document.getElementById('myChart').getContext('2d');
            if(myChart) myChart.destroy();
            myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        fill: false,
                        data: data,
                        backgroundColor: 'rgba(52, 119, 235, 0.2)',
                        borderColor: 'rgba(52, 119, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        function updateChartDefault() {
            fetch('_chartFilter.php?filter=harian')
                .then(response => response.json())
                .then(data => {
                    drawChart(data.labels, data.data, 'Jumlah Pelanggaran per Hari');
                })
                .catch(error => console.error('Error:', error));
        }
        updateChartDefault();

        // Event listener untuk dropdown
        document.querySelectorAll('.dropdown-item').forEach(function (item) {
            item.addEventListener('click', function (event) {
                event.preventDefault();
                var filterType = event.target.getAttribute('data-filter');

                // Panggil fungsi PHP dengan AJAX dan perbarui chart setelah mendapatkan hasil
                fetch('_chartFilter.php?filter=' + filterType)
                    .then(response => response.json())
                    .then(data => {
                        drawChart(data.labels, data.data, 'Jumlah Pelanggaran per ' + filterType.charAt(0).toUpperCase() + filterType.slice(1));
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>
</body>

</html>