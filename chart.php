<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/bootstrap.css">
    <link rel="stylesheet" href="/css/chart.css">
    <link rel="stylesheet" href="/css/global.css">
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

                <form action="" class="option d-flex text-center" id="form">
                    <div class="option-list">
                        <input type="radio" name="option" class="input" id="hari">
                        <label for="hari" class="label" >Hari</label>
                    </div>

                    <div class="option-list">
                        <input type="radio" name="option" class="input" id="bulan">
                        <label for="bulan" class="label" >Bulan</label>
                    </div>

                    <div class="option-list">
                        <input type="radio" name="option" class="input" id="tahun">
                        <label for="tahun" class="label" >Tahun</label>
                    </div>

                    <input class="go mb" type="submit" value="GO">
                </form>
            </div>
        </div>
    </div>

    <script src="/js/sidebar.js"></script>
    <script>
        document.getElementById('form').onsubmit = function(event) {
            event.preventDefault();
            const selectedOption = document.querySelector('input[name="option"]:checked');

            if (selectedOption) {
                const optionValue = selectedOption.id;
                switch (optionValue) {
                    case "hari":
                        window.location.href = "chartHarian.php";
                        break;
                    case "bulan":
                        window.location.href = "chartBulanan.php";
                        break;
                    case "tahun":
                        window.location.href = "halaman_tahun.html";
                        break;
                    default:
                        break;
                }
            } else {
                alert("Pilih salah satu opsi terlebih dahulu!");
            }
        }
    </script>
</body>

</html>