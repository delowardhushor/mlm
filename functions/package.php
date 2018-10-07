<?php
	include 'allhelper.php';

	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$name = $_POST['name'];
		$price = $_POST['price'];
		$stock = $_POST['stock'];
		$details = $_POST['details'];
		$mode = $_POST['mode'];
		
		if($mode === 'Add'){
			$insert = "INSERT INTO mlm_packages (name, price, stock, details) VALUES ('$name', '$price', '$stock', '$details')";
			$result = $db->insert($insert);
		}elseif($mode === 'Update'){
			$id = $_POST['id'];
			$update = "UPDATE mlm_packages SET 
						name='$name', 
						price='$price', 
						stock='$stock', 
						details='$details'
						WHERE id= '$id' ";
			$result = $db->update($update);
		}
		
		if($result){
			header('Location:../packages.php');
		}else{
			echo "<script>alert('Something Went Wrong')</script>";
		}
	}
?>