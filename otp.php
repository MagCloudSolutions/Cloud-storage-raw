<?php
$verified = false;
$alreadyRegistered = false;
$Failed = false;
require('partial/config.php');
if (isset($_GET['email']) && isset($_GET['verification_code'])) {
    $query = "SELECT * FROM `signup` WHERE `signup`.`email`='$_GET[email]' AND `signup`.`verification_code`='$_GET[verification_code]'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $result_fetch = mysqli_fetch_assoc($result);

            if ($result_fetch['status'] == '0') {
                $update = "UPDATE `signup` SET `status` = '1' WHERE `signup`.`email` = '$result_fetch[email]';";
                $run = mysqli_query($conn, $update);
                if ($run) {
                    $verified = true;
                }
            } else {
                $alreadyRegistered = true;
            }

        }

    } else {
        $Failed = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="partial/style.css">
    <link rel="icon" href="favicon.ico">
</head>

<body class="body">
    <!-- <video id="background-video" autoplay loop muted poster="">
        <source src="partial/back1.mp4" type="video/mp4">
    </video> -->
    <?php
    require "partial/nav.php";
    ?>


    <div class="container" style="margin-top: 20px;">
        <div id="intro" class="bg-image shadow-2-strong">
            <div class="mask d-flex align-items-center h-100">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-md-8">
                            <form class="bg rounded shadow-5-strong p-5" action="register.php" method="post"
                                style="border: 2px solid antiquewhite; ">
                                <?php
                                if ($verified) {
                                    echo '<h2 class="form-label">Verification Successful!</h2>
                                    <hr>
                                    <!-- Email input -->
                                    <div class="form-outline mb-4">
                                        <a class="form-label" href="login.php">Login here</a>
                                    </div>';
                                }

                                if ($alreadyRegistered) {
                                    echo '<h2 class="form-label">Email Already Verified!</h2>
                                    <hr>
                                    <!-- Email input -->
                                    <div class="form-outline mb-4">
                                        <a class="form-label" href="login.php">Login here</a>
                                    </div>';
                                }

                                if ($Failed) {
                                    echo '<h2 class="form-label">Verification Successful!</h2>';
                                }
                                ?>
                            </form>
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
</body>

</html>