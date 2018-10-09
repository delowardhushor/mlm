<?php

	if($_SERVER['REQUEST_METHOD'] === 'POST' && session::get("login") == true){
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
			header('Location:packages.php?success=Package '.$mode);
		}else{
			header('Location:packages.php?error=Could Not '.$mode);
		}
	}

	if(isset($_GET['delete']) && session::get("login") == true){
		$id = $_GET['delete'];
		$sql = "DELETE FROM mlm_packages WHERE id = '$id' ";
		$result = $db->delete($sql);
		if($result){
			header('Location:packages.php?success=Package Deleted');
		}else{
			header('Location:packages.php?error=Could Not Delete');
		}

	}
?>