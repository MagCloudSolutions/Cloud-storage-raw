<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$showAlert = false;
$emailError = false;
$passwordError = false;
$internalError = false;


function sendMail($email, $verification_code)
{

  require('PHPMailer/PHPMailer.php');
  require('PHPMailer/SMTP.php');
  require('PHPMailer/Exception.php');

  $mail = new PHPMailer(true);

  try {
    $mail->isSMTP(); //Send using SMTP
    $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
    $mail->SMTPAuth = true; //Enable SMTP authentication
    $mail->Username = 'loginpage219@gmail.com'; //SMTP username
    $mail->Password = 'pchrphgbbmsgjrfa'; //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
    $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('loginpage219@gmail.com', 'CS Cloud');
    $mail->addAddress($email);

    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = 'Email Verification from CS Cloud';
    $mail->Body = '<h3>Thanks for Registration</h3>
      </br>
      <h7>Click the link below to verift your email address.</h7>
      </br>
      <a href = "http://localhost/cs-cloud/otp.php?email=' . $email . '&verification_code=' . $verification_code . '" >Verify</a>';

    $mail->send();
    return true;
  } catch (Exception $e) {
    return false;
  }
}
;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include "partial/config.php";

  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $c_password = $_POST['c_password'];

  $existsql = "SELECT * FROM signup where email='$email'";
  $result = mysqli_query($conn, $existsql);
  $numExistRows = mysqli_num_rows($result);

  if ($numExistRows > 0) {
    $emailError = true;

  } else {
    if ($password == $c_password) {
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $verification_code = bin2hex(random_bytes(16));
      $sql = "INSERT INTO `signup` (`name`, `email`, `password`, `date`, `verification_code`, `status`) VALUES ('$name', '$email', '$hash', current_timestamp(), '$verification_code', '0');";
      $result = mysqli_query($conn, $sql);

      if ($result && sendMail($_POST['email'], $verification_code)) {
        $showAlert = true;
      } else {
        $internalError = true;
      }
    } else {
      $passwordError = true;
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-up</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="partial/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css"
        integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">
    <link rel="icon" href="favicon.ico">

</head>

<body>
    <!-- <video id="background-video" autoplay loop muted poster="">
        <source src="partial/back1.mp4" type="video/mp4">
    </video> -->



    <?php
    require "partial/nav.php";
    ?>

    <?php
    if ($showAlert) {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong>&nbsp;Account created successfully
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    if ($emailError) {

      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong>&nbsp;Email already Exist
          <button type="button" id="emailExist" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    if ($passwordError) {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Error!</strong>&nbsp;Password Do not match
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    if ($internalError) {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Error!</strong>&nbsp;System ran into some problem
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>
    <!--Hey! This is the original version
of Simple CSS Waves-->

    <div class="header">

        <!--Content before waves-->
        <div class="inner-header flex">
            <!--Just the logo.. Don't mind this-->

            <div class="container" style="margin-top: 20px; margin-bottom:20px;">
                <div id="intro" class="bg-image shadow-2-strong">
                    <div class="mask d-flex align-items-center h-100">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-xl-5 col-md-8">
                                    <form class="bg rounded shadow-5-strong p-5" action="register.php" method="post"
                                        style="border: 2px solid antiquewhite; ">
                                        <h2 class="form-label">Please Register Here:</h2>
                                        <hr>
                                        <!-- Email input -->
                                        <div class="form-outline mb-4">
                                            <input type="text" id="form1Example1" maxlength="256" name="name"
                                                class="form-control" style="border: 1px solid #A2B5BB;" />
                                            <label class="form-label" for="form1Example1">Name</label>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <input type="email" id="form1Example1" maxlength="256" name="email"
                                                class="form-control" style="border: 1px solid #A2B5BB" />
                                            <label class="form-label" for="form1Example1">Email address</label>
                                        </div>

                                        <!-- Password input -->
                                        <div class="form-outline mb-4">
                                            <input type="password" name="password" maxlength="10" id="form1Example2"
                                                class="form-control" style="border: 1px solid #A2B5BB" />
                                            <label class="form-label" for="form1Example2">Password</label>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <input type="password" name="c_password" maxlength="10" id="form1Example2"
                                                class="form-control" style="border: 1px solid #A2B5BB" />
                                            <label class="form-label" for="form1Example2">Confirm Password</label>
                                        </div>


                                        <!-- Submit button -->
                                        <button type="submit" class="btn btn-dark">Sign up</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Waves Container-->
        <div>
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave"
                        d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">
                    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                    <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
                </g>
            </svg>
        </div>
        <!--Waves end-->

    </div>
    <!--Header ends-->

    <!--Content starts-->
    <div class="content flex">
    </div>
    <!--Content ends-->

    <?php
    require "partial/footer.php";
    ?>

    <script type="text/javascript">
    document.getElementsByClassName("emailExist").onclick = function() {
        location.href = "login.php";
    };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>


</html>