
<?php

// Database and other necessary files included in require.php
require 'bootstrap.php';

Session::checkSession();

if(isset($_GET['logStatus']) AND $_GET['logStatus'] == 'logout'){

  Session::destroy();

}

extract($_SESSION);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>MyBilling</title>

<?php include 'stylesheet.php'; ?>

</head>

<body>

  <div id="wrapper">

    <!-- ToopBar Bar Start -->
    <div id="tobBar">
      <div class="logoArea">
        <img src="assets/images/whitemybillinglogo.png" alt="">
      </div>
      <div class="sideBarHumberger">
      <i class="fa fa-bars"></i>
      </div>
      <div class="mybillingInfoArea">
        <h2>Nextech Ltd</h2>
        <div class="loggedUserInfo">
          <p>Sub Office: adsasd</p>
          <p>Designation: sdfasdfs</p>
        </div>
      </div>
      <div class="topUserArea">
        <i class="fa fa-user"></i>
        <?= $_SESSION['SUserName']; ?>
        <ul class="topUserAreaSubMenu">
          <li><a href="">Change Password</a></li>
          <li><a href="#" data-toggle="modal" data-target="#logOutModal">LogOut</a></li>
        </ul>
      </div>
    </div>
    <!-- ToopBar Bar End -->