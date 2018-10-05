<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mlm";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM mlm_members";
$result = $conn->query($sql); 

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$name = $_POST['name'];
	$parent_member = $_POST['parent_member'];
	$sql = "INSERT INTO mlm_members (name, parent_member)
	VALUES ('$name', '$parent_member')";
	$paraent_sql =  "UPDATE mlm_members SET balance = balance + 200 WHERE id = '$parent_member'";
	if ($conn->query($sql) && $conn->query($paraent_sql)) {

	    header('Location: index.php');
	} 
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>MLM</title>
</head>
<body>
	<form action="" method="POST">
		<input name="name" />
		<select name="parent_member">
			<?php 
				if ($result->num_rows > 0) {
    				while($row = $result->fetch_assoc()) {
    		?>
					<option value="<?php echo $row["id"]; ?>"><?php echo  $row["name"]; ?></option>
			<?php
					}
				}
			?>
		</select>
		<input type="submit"  />
	</form>
</body>
</html>