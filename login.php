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
    $pass = md5($_POST['pass']);

    $type = $_POST['type'];

    $table = 'mlm_members';

    if($type == 'admin'){
      $table = 'mlm_users';
    }

    $sql = "SELECT email,id FROM $table WHERE email = '$email' AND pass = '$pass' LIMIT 1 ";

    $result = $db->select($sql);

    if ($result != false) {
      $value = mysqli_fetch_array($result);
      $row = mysqli_num_rows($result);
      if ($row > 0 ) {
        
        session::set("login", true );
        session::set("usertype", $type );
        session::set("email", $value['email']);
        session::set("userid", $value['id']);
        header('Location:statistics.php');
      }else{
        echo "<script>alert('Username doesn't exist');</script>";
      }
    }else{
      echo "<script>alert('Username doesn't exist')</script>";
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
    MLM - Login
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

    <p class="h4 mb-4">Sign in</p>

    <!-- Email -->
    <input type="email" required="1" name="email" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="E-mail">

    <!-- Password -->
    <input type="password" required="1" name='pass' id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Password">

    
    <div class="d-flex justify-content-around">
        <label class="radio-inline">
          <input type="radio" required="1" name="type" value="admin" checked> I am Admin
        </label>
        <label class="radio-inline">
          <input checked type="radio" required="1" value="member" name="type"> I am Member
        </label>
    </div>

    <!-- Sign in button -->
    <button class="btn btn-info btn-block my-4" type="submit">Sign in</button>
    <!-- <div class="d-flex justify-content-around">
        <div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="defaultLoginFormRemember">
                <label class="custom-control-label" for="defaultLoginFormRemember">Remember me</label>
            </div>
        </div>
        <div>
            <a href="forgetpassword.php">Forgot password?</a>
        </div>
    </div> -->
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
</body>

</html>