<?php
    include "lib/session.php"; 
    session::chk_login();
?>
<?php include "config/config.php"; ?>
<?php include "lib/Database.php"; ?>
<?php include "helpers/format.php"; ?>

<?php
$db= new database();
$format= new format();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $type = $_POST['type'];

    $table = 'mlm_members';

    if($type == 'admin'){
      $table = 'mlm_users';
    }

    $sql = "SELECT email FROM $table WHERE email = '$email' LIMIT 1 ";

    $result = $db->select($sql);

    if ($result != false) {
      $email = (mysqli_fetch_array($result))['email'];

      $msg = rand ( 100000 , 999999 );
      $pass = md5($msg);
      $msg = wordwrap($msg,70);
      
      if($db->update("UPDATE $table SET pass = '$pass' WHERE email = '$email'") && mail($email,"Temporary Password of Your MLM Account",$msg)){
        header('Location:forgetpassword.php?success=Email Sent');
      }
    }else{
      header('Location:forgetpassword.php?error=Invalid Email');
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    MLM - Recover Password
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="./assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="./assets/demo/demo.css" rel="stylesheet" />
</head>
<body>
	<!-- Default form login -->
    <div style="margin: 0 auto;" class="col-12 col-sm-6 col-md-4">
<form action='' method="POST" class="text-center border border-light p-5">

    <p class="h4 mb-4">Recover Password</p>

    <!-- Email -->
    <input type="email" required="1" name="email" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="E-mail">

    
    <div class="d-flex justify-content-around">
        <label class="radio-inline">
          <input type="radio" required="1" name="type" value="admin" checked> I am Admin
        </label>
        <label class="radio-inline">
          <input checked type="radio" required="1" value="member" name="type"> I am Member
        </label>
    </div>

    <!-- Sign in button -->
    <button class="btn btn-info btn-block my-4" type="submit">Recover</button>
    <div class="d-flex justify-content-around">
        <div>
            <a href="login.php">Want to Login?</a>
        </div>
    </div>
</form>
</div>
<!-- Default form login -->
<!--   Core JS Files   -->
  <script src="./assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chartist JS -->
  <script src="./assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="./assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="./assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      //init DateTimePickers
      md.initFormExtendedDatetimepickers();
    });
  </script>
  <?php
    if(isset($_GET['success'])){
  ?>
      <script>demo.showNotification('success', '<?php echo $_GET['success']; ?>' )</script>

  <?php
    }
    if(isset($_GET['error'])){
  ?>
      <script>demo.showNotification('danger', '<?php echo $_GET['error']; ?>' )</script>
  <?php
    }
  ?>
</body>

</html>