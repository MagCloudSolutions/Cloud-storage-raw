<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "partial/config.php";
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * from signup where email = '$email'";
    $result = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($result);

}

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="partial/style.css">
    <link rel="icon" href="favicon.ico">
</head>

<body class="body">

    <?php
    require "partial/nav.php";
    ?>


    <!-- <video id="background-video" autoplay loop muted poster="">
        <source src="partial/back1.mp4" type="video/mp4">
    </video> -->
    <style>

    </style>


    <div class="container" style="margin-top: 20px;">
        <div id="intro" class="bg-image shadow-2-strong">
            <div class="mask d-flex align-items-center h-100">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-md-8">
                            <div class=" rounded shadow-5-strong p-5" style="border: 2px solid antiquewhite">
                                <h2 class="form-label">Welcome,
                                    <?php
                                    include "partial/config.php";
                                    $email = $_SESSION['email'];
                                    $sql = "SELECT * from signup where email = '$email'";
                                    $result = mysqli_query($conn, $sql);

                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['name'] . "!" ?>
                                </h2>
                                <!-- Email input -->

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <div class="upload-area">
                                        <button class="bn54 upload"><span class="bn54span">Upload</span></button>
                                        <div class="progress-container">
                                            <div class="progress"></div>
                                        </div>
                                        <div class="percent form-label">0%</div>
                                        <div class="controls">
                                            <svg class="pause" xmlns="http://www.w3.org/2000/svg" height="24"
                                                viewBox="0 0 24 24" width="24">
                                                <path d="M0 0h24v24H0V0z" fill="none" />
                                                <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z" />
                                            </svg>
                                            <svg class="resume" xmlns="http://www.w3.org/2000/svg" height="24"
                                                viewBox="0 0 24 24" width="24">
                                                <path
                                                    d="M8 6.82v10.36c0 .79.87 1.27 1.54.84l8.14-5.18c.62-.39.62-1.29 0-1.69L9.54 5.98C8.87 5.55 8 6.03 8 6.82z" />
                                            </svg>
                                            <svg class="cancel" xmlns="http://www.w3.org/2000/svg" height="24"
                                                viewBox="0 0 24 24" width="24">
                                                <path d="M0 0h24v24H0V0z" fill="none" />
                                                <path
                                                    d="M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z" />
                                            </svg>
                                        </div>
                                        <input type="file" class="hidden-upload-btn" style="display: none;">
                                    </div>
                                    <div class="all-files">
                                        <h2 class="form-label">Videos</h2>
                                        <ul id="video"></ul>
                                        <h2 class="form-label">Audios</h2>
                                        <ul id="audio"></ul>
                                        <h2 class="form-label">Images</h2>
                                        <ul id="image"></ul>
                                    </div>
                                    <div class="expand-container" data-value="0">
                                        <ul>
                                            <li class="form-label" onclick="openFile(this)">Open</li>
                                            <li class="form-label" onclick="downloadFile(this)">Download</li>
                                            <li class="form-label" onclick="deleteFile(this)">Delete</li>
                                        </ul>
                                        <!-- Preloader image -->
                                        <img class="loader"
                                            src="https://aux.iconspalace.com/uploads/11080764221104328263.png" alt="">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    require "partial/footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
    <script src="index.js"></script>
</body>

</html>