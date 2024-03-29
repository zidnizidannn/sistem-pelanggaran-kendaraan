<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/bootstrap.css">
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="/css/chart.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script src="assets/bootstrap.bundle.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script> -->
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


                <form class="option-harian d-flex justify-content-evenly align-items-center">
                    <a href="chart.php" style="text-decoration: none; color: black;">
                        <span class="back material-symbols-outlined" style="cursor: pointer;" data-bs-toggle="tooltip" data-bs-placement="top" title="Menu Pilihan">
                            arrow_back
                        </span>
                    </a>

                    <div class="dropdown" id="bulan">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            Bulan
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu"></ul>
                    </div>

                    <div class="dropdown" id="tahun">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            Tahun
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu"></ul>
                    </div>

                    <input class="go" type="submit" value="GO">

                </form>
                <!-- grafik -->
                <canvas class="" id="myChart" style="max-width:75%; max-height:85%; background-color: white; margin: 3em 0em"></canvas>
            </div>
        </div>
    </div>

    <script src="/js/chart.js"></script>
    <script>
        generateDrowdownItem('#bulan.dropdown .dropdown-menu', NAMA_BULAN);
        generateDrowdownItem('#tahun.dropdown .dropdown-menu', 2023, year);
        attachItemClickHandler('bulan', m => {
            month = parseInt(m);
        });
        attachItemClickHandler('tahun', y => {
            year = parseInt(y);
        });

        document.querySelector('.go').addEventListener('click', function(e) {
            e.preventDefault();
            fetch(`/_getMonthlyData.php?y=${year}&m=${month+1}`)
                .then(result => result.json())
                .then(data => makeChart(data, "Jumlah Pelanggaran per Bulan"));
        });
    </script>
</body>

</html>