<?php
    include "lib/session.php"; 
    session::chk_session();
?>
<?php include "config/config.php"; ?>
<?php include "lib/Database.php"; ?>
<?php include "helpers/format.php"; ?>

<?php
$db= new database();
$format= new format();

if(isset($_GET['logout'])){
	session::destroy();
}

?>