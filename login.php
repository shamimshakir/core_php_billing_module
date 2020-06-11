
<?php
  require 'bootstrap.php';

  if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $authUser = $auth->authenticateUser($username, $password);
    
  }

  Session::checkLogin();   

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>MyBilling | Login</title>

  <!-- Login Page Css -->
  <link rel="stylesheet" href="assets/css/login.css">

</head>

<body>

  <div class="loginFormSection">

    <div class="loginFormMybillingInfo">

      <div class="loginFormMybillingInfoContent">
        <img src="assets/images/whitemybillinglogo.png" alt="">

        <p>Mybilling ISP ERP is a premier Radius Billing, CRM & Trouble Ticketing, Accounting, 
        Inventory, HR & Payroll management software. Mybilling is an ISP ERP software framework 
        created for Internet Service Providers. Any size of ISP can use this software to 
        convert their ISP operation in Automation System.</p>

        <a href="http://mybilling.cloud/">Learn More</a>
      </div>

    </div>

    <div class="loginFormMain">

      <!-- Login Error Message Show  -->
      <?php if(isset($authUser)):?>
        <span class="loginErrMsg"><?=$authUser; ?></span>
      <?php endif; ?>

      <!-- Login Form Start -->
      <div class="loginFormMainContent">
        <h2>Singin</h2>
        <form action="" method="post" autocomplete="off">
          <input type="text" name="username" id="username" placeholder="Username">
          <input type="password" name="password" id="password" placeholder="Password">
          <button type="submit" name="login">Login</button>
        </form>
      </div>
      <!-- Login Form End -->

    </div>

  </div>

</body>

</html>
