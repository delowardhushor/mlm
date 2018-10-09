<?php

	if($_SERVER['REQUEST_METHOD'] === 'POST' && session::get("login") == true){


		$old_pass = md5($_POST['old_pass']);
		$new_pass = md5($_POST['new_pass']);

		$userid = session::get('userid');
		$sql = "SELECT * FROM mlm_users WHERE id = '$userid' LIMIT 1 ";
		$result = $db->select($sql);
		if ($result != false) {
			$value = mysqli_fetch_array($result);
			if($value['pass'] === $old_pass){
				if($db->update("UPDATE mlm_users SET pass = '$new_pass' WHERE id = '$userid' ")){
					header('Location:profile.php?success=Password Updated');
				}
			}else{
				header('Location:profile.php?error=Wrong Password');
			}
		}
	}
?>