<?php

	if($_SERVER['REQUEST_METHOD'] === 'POST' && session::get("login") == true){


		$old_pass = md5($_POST['old_pass']);
		$new_pass = md5($_POST['new_pass']);

		$table = 'mlm_members';

		if(session::get('usertype') == 'admin'){
	      $table = 'mlm_users';
	    }

		$userid = session::get('userid');
		$sql = "SELECT * FROM $table WHERE id = '$userid' LIMIT 1 ";
		$result = $db->select($sql);
		if ($result != false) {
			$value = mysqli_fetch_array($result);
			if($value['pass'] === $old_pass){
				if($db->update("UPDATE $table SET pass = '$new_pass' WHERE id = '$userid' ")){
					//header('Location:profile.php?success=Password Updated');
					echo "<script>window.location ='profile.php?success=Password Updated';</script>";
				}
			}else{
				//header('Location:profile.php?error=Wrong Password');
				echo "<script>window.location ='profile.php?error=Wrong Password';</script>";

			}
		}
	}
?>