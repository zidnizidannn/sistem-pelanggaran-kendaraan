<?php
session_start();

include '_connDb.php';
$conn = connectDatabase();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    if ($_POST['action'] == 'login' && !empty($_POST['username']) && !empty($_POST['pass'])) {
        $username = $_POST['username'];
        $password = $_POST['pass'];

        $sql = "SELECT pass FROM userlogin WHERE username='$username'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);

            if ($password === $row['pass']) {
                $_SESSION['username'] = $username;
                header("Location: home.php");
                exit();
            } else {
                $loginError = "Invalid username or password";
            }
        } else {
            $loginError = "Error fetching user data";
        }
    }
}

closeDatabase($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link rel="stylesheet" href="css/global.css">
    <style>
        /* Your styles here */
    </style>
</head>

<body class="main-index d-flex align-items-center justify-content-center">
    <div class="card rounded-3 border-1 p-4">
        <form class="" id="login-form" method="post" action="" style="width: 23rem; height: 17rem;">
            <h3 class="login text-center fw-bold">Login Account!</h3>
            <div class="form-group mt-3">
                <label for="login-username">Username</label>
                <input type="text" class="form-control" id="login-username" name="username" placeholder="Masukkan Username">
            </div>

            <div class="form-group mt-3">
                <label for="login-password">Password</label>
                <input type="password" class="form-control" id="login-password" name="pass" placeholder="Password">
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn strong" name="action" value="login">Login</button>
            </div>
        </form>
    </div>
    <script src="js/script.js"></script>
</body>

</html>