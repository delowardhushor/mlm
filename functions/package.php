<?php

	if($_SERVER['REQUEST_METHOD'] === 'POST' && session::get("usertype") == 'admin'){
		$name = $_POST['name'];
		$price = $_POST['price'];
		$stock = $_POST['stock'];
		$details = $_POST['details'];
		$mode = $_POST['mode'];
		$cost = $_POST['cost'];
		
		if($mode === 'Add'){
			$insert = "INSERT INTO mlm_packages (name, price, stock, details, cost) VALUES ('$name', '$price', '$stock', '$details', '$cost')";
			$result = $db->insert($insert);
		}elseif($mode === 'Update'){
			$id = $_POST['id'];
			$update = "UPDATE mlm_packages SET 
						name='$name', 
						price='$price', 
						stock='$stock', 
						details='$details',
						cost = '$cost'
						WHERE id= '$id' ";
			$result = $db->update($update);
		}
		
		if($result){
			//header('Location:packages.php?success=Package '.$mode);
			echo "<script>window.location ='packages.php?success=Package ".$mode."';</script>";

		}else{
			//header('Location:packages.php?error=Could Not '.$mode);
			echo "<script>window.location ='packages.php?error=Could Not ".$mode."';</script>";
		}
	}

	if(isset($_GET['delete']) && session::get("usertype") == 'admin'){
		$id = $_GET['delete'];
		$sql = "DELETE FROM mlm_packages WHERE id = '$id' ";
		$result = $db->delete($sql);
		if($result){
			//header('Location:packages.php?success=Package Deleted');
			echo "<script>window.location ='packages.php?success=Package Deleted';</script>";
		}else{
			//header('Location:packages.php?error=Could Not Delete');
			echo "<script>window.location ='packages.php?error=Could Not Deleted';</script>";

		}

	}
?>