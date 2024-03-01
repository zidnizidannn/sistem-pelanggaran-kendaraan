<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/bootstrap.css">
    <link rel="stylesheet" href="/css/global.css">
    <!-- <link rel="stylesheet" href="css/home.css"> -->
    <script src="assets/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style>
        .sidebar .menu #home{
            background-color: #0087CC ;
            color: white;
        }
    </style>
</head>
<body class="">
    <div class="container1 d-flex">
        <!-- SIDEBAR -->
        <?php include 'layout/sidebar.html'?>
        <!-- CONTENT -->
        <div class="main-content">
            <?php include 'layout/header.html'?>
            <div class="content d-flex flex-column align-item-center justify-content-center" style="margin-left: 5rem;">
                <div class="">
                    <h1 class="">SELAMAT DATANG<br>DI WEBSITE KAMI!</h1>
                    <p class="">PASAL 207 AYAT 1 NO. 22 TAHUN 2009</p>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/sidebar.js"></script>
</body>
</html>