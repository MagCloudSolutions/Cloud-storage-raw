<?php
$showError = false;
$login = false;
$mailIDerror = false;
$passwordError = false;



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "partial/config.php";
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * from signup where email = '$email'";
    $result = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($result);

    if ($num == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password']) && $row['status'] == '1') {
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                header('Location: home.php');

            } else {
                if (!password_verify($password, $row['password'])) {
                    $passwordError = true;
                } else if ($row['status'] != '1') {
                    $mailIDerror = true;
                }
            }
        }
    } else {
        $showError = true;

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

    <?php
    if ($login) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong>&nbsp;You are logged in
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    if ($showError) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Error!</strong>&nbsp;Invalid Credentials
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    if ($passwordError) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong>&nbsp;Incorrect Password.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    if ($mailIDerror) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong>&nbsp;Email not verified please check your mail inbox.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    ?>

    <div class="container" style="margin-top: 20px;">
        <div id="intro" class="bg-image shadow-2-strong">
            <div class="mask d-flex align-items-center h-100">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-md-8">
                            <form class=" rounded shadow-5-strong p-5" action="login.php" method="post"
                                style="border: 2px solid antiquewhite">
                                <h2 class="form-label">Please Login Here!</h2>
                                <hr>
                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <input type="email" maxlength="25" id="form1Example1" name="email"
                                        class="form-control" style="border: 1px solid #A2B5BB" />
                                    <label class="form-label" for="form1Example1">Email address</label>
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <input type="password" maxlength="10" name="password" id="form1Example2"
                                        class="form-control" style="border: 1px solid #A2B5BB" />
                                    <label class="form-label" for="form1Example2">Password</label>
                                </div>

                                <!-- 2 column grid layout for inline styling -->
                                <div class="row mb-4">
                                    <div class="col d-flex justify-content-center">
                                    </div>

                                    <div class="col text-center">
                                        <!-- Simple link -->
                                        <a class="form-label" href="#!">Forgot password?</a>
                                    </div>
                                </div>

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-dark">Login</button>
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