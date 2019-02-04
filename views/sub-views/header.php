<!DOCTYPE html>
<html lang="en">
<head>
		<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
		<!-- Local Link -->
</head>

<?php 
include_once __DIR__."/../../services/auth-services.php";
session_start(); 
$isAuthenticated = $_SESSION['is_authenticated'] ?? false;
$fname = $_SESSION['fname'] ?? '';

?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Kirana-store</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <?php
    if($isAuthenticated == true) {
    ?>
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <?php } ?>
    <ul class="navbar-nav ml-auto">
    <?php 
      if ($isAuthenticated == true) {

        ?>
        <li>
        <form class="d-flex flex-row my-2 my-lg-0 text-center" method="post">
          <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->
          <p class="mr-2 text-center"><?=$fname?></p>
          <button class="btn btn-outline-success my-2 my-sm-0" id="logout-btn"  formaction="/kirana-store/views/auth-views/logout" type="submit">Logout</button>
        </form>
      </li>
        <?php
      } else {
        ?>
        <li>
          <form class="d-flex flex-row my-2 my-lg-0" method="post">
          <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->
          <button  formaction="register" class="btn btn-success my-2 my-sm-0 mr-1" type="submit">Register</button>
          <button  formaction="login" class="btn btn-outline-success my-2 my-sm-0" type="submit">Login</button>
        </form>
      </li>
        <?php
      }
    ?>

    </ul>

    <!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form> -->

</nav>


<!-- Local Links -->
<script src="assets/js/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
<script src="assets/js/popper.min.js"  crossorigin="anonymous"></script>
<script src="assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
<!-- CDN Links -->
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->