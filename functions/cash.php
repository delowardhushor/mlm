<?php
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$amount = $_POST['amount'];
		// $transaction_number = $_POST['transaction_number'];
		// $sent_mobile = $_POST['sent_mobile'];
		$req_sql = "INSERT INTO mlm_cashout (member, amount, mode) VALUES ('$member', '$amount','$mode')";
		if($mode == 'in'){
			$mobile_from = $_POST['mobile_from'];
			$tan_id = $_POST['tan_id'];
			$req_sql = "INSERT INTO mlm_cashout (member, amount, mode, mobile_from, tan_id) VALUES ('$member', '$amount', '$mode', '$mobile_from', '$tan_id')";
		}
		if($db->insert($req_sql))
		{
			header('Location:cash.php?mode='.$mode.'&member='.$member.'&success=Request Sent');
		}
	}
?>