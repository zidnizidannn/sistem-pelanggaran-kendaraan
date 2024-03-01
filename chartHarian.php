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


                <form class="option-harian d-flex justify-content-evenly align-items-center">
                    <a href="chart.php" style="text-decoration: none; color: black;">
                        <span class="back material-symbols-outlined" style="cursor: pointer;" data-bs-toggle="tooltip" data-bs-placement="top" title="Menu Pilihan">
                            arrow_back
                        </span>
                    </a>

                    <div class="dropdown" id="tanggal">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenu  " data-bs-toggle="dropdown" aria-expanded="false">
                            Tanggal
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                            <?php
                            // include '_connDb.php';
                            // $conn = connectDatabase();

                            // $sql = "SELECT DATE_FORMAT(tanggal, '%d') AS tanggal FROM data_pelanggaran ORDER BY tanggal";
                            // $result = mysqli_query($conn, $sql);
                            // while ($row = mysqli_fetch_assoc($result)) {
                            //     $tanggal = $row['tanggal'];

                            //     echo "<li><a class='dropdown-item' href='#'>" . $tanggal . "</a></li>";
                            // }
                            for ($i = 1; $i < 31; $i++) {
                                echo "<li><a class='dropdown-item' href='#'>" . $i . "</a></li>";
                            }
                            ?>
                        </ul>
                    </div>

                    <div class="dropdown" id="bulan">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            Bulan
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                            <?php
                            for ($m = 1; $m <= 12; ++$m) {
                                echo "<li><a class='dropdown-item' href='#'>" . date('F', mktime(0, 0, 0, $m, 1)) . "</a></li>";
                            }
                            ?>
                        </ul>
                    </div>

                    <div class="dropdown" id="tahun">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            Tahun
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                            <li><a class="dropdown-item" href="#">2023</a></li>
                            <li><a class="dropdown-item" href="#">2024</a></li>
                        </ul>
                    </div>

                    <input class="go" type="submit" value="GO">

                </form>
                <!-- grafik -->
                <canvas class="" id="myChart" style="max-width:75%; max-height:85% ;background-color:white; display: none;"></canvas>
            </div>
        </div>
    </div>

    <script src="/js/home.js"></script>
    <script>
        function updateText(dropdown, toggle) {
            dropdown.addEventListener('click', function(e) {
                if (e.target.classList.contains('dropdown-item')) {
                    const selection = e.target.textContent;
                    toggle.textContent = selection;
                }
            });
        }
        const dropdownHari = document.getElementById('tanggal');
        const optionHari = dropdownHari.querySelector('.dropdown-toggle');
        updateText(dropdownHari, optionHari);

        const dropdownBulan = document.getElementById('bulan');
        const optionBulan = dropdownBulan.querySelector('.dropdown-toggle');
        updateText(dropdownBulan, optionBulan);

        const dropdownTahun = document.getElementById('tahun');
        const optionTahun = dropdownTahun.querySelector('.dropdown-toggle');
        updateText(dropdownTahun, optionTahun);
    </script>
</body>

</html>