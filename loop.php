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

$sql = "INSERT INTO mlm_members (name, parent_member)
VALUES ('John', 'Doe')";

for ($i=0; $i < 32 ; $i++) { 
	$conn->query($sql);
}

$conn->close();
?>