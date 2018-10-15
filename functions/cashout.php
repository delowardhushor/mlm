<?php
	if($_SERVER['REQUEST_METHOD'] === 'POST' && session::get("usertype") == 'admin'){
		$amount = $_POST['amount'];
		if(
			$db->insert("INSERT INTO mlm_cashout (member, amount) VALUES ('$member', '$amount') ") 
			&&
			$db->insert("UPDATE mlm_members SET balance = balance-'$amount' WHERE id = '$member' ")
		)
		{
			header('Location:cashout.php?member='.$member.'&success=Cashout Success');
		}
	}
?>