<?php
	if($_SERVER['REQUEST_METHOD'] === 'POST' && session::get("usertype") == 'admin'){
		$amount = $_POST['amount'];
		$transaction_number = $_POST['transaction_number'];
		$sent_mobile = $_POST['sent_mobile'];
		if(
			$db->insert("INSERT INTO mlm_cashout (member, amount, transaction_number, sent_mobile) VALUES ('$member', '$amount', '$transaction_number', '$sent_mobile') ") 
			&&
			$db->insert("UPDATE mlm_members SET balance = balance-'$amount' WHERE id = '$member' ")
		)
		{
			header('Location:cash.php?member='.$member.'&success=Cashout Success');
		}
	}
?>