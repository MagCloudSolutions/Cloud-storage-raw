<?php

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  $loggedin = true;
} else {
  $loggedin = false;
}

echo '<nav class="navbar navbar-dark bg-dark navbar-expand-lg" style="position: relative">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">CS Cloud</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse active" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home.php">Home</a>
        </li>';
if (!$loggedin) {
  echo '<li class="nav-item">
          <a class="nav-link active" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="register.php">Sign Up</a>
        </li>';
}
if ($loggedin) {
  echo '<li class="nav-item">
          <a class="nav-link active" href="logout.php">Logout</a>
        </li>';
}
echo '</ul>
    </div>
  </div>
</nav>' ?>