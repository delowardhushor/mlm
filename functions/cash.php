<?php
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cashRequest'])){
		$amount = $_POST['amount'];
		// $transaction_number = $_POST['transaction_number'];
		// $sent_mobile = $_POST['sent_mobile'];
		$req_sql = "INSERT INTO mlm_cashout (member, amount, mode) VALUES ('$member', '$amount','$mode')";
		if($mode == 'in'){
			$mobile_from = $_POST['mobile_from'];
			$tan_id = $_POST['tan_id'];
			$pay_type = $_POST['pay_type'];
			$req_sql = "INSERT INTO mlm_cashout (member, amount, mode, mobile_from, tan_id, pay_type) VALUES ('$member', '$amount', '$mode', '$mobile_from', '$tan_id', '$pay_type')";
			$db->insert($req_sql);
			header('Location:cash.php?mode='.$mode.'&member='.$member.'&success=Request Sent');
		}else{
			$tan_bal = mysqli_fetch_array($db->select("SELECT tan_bal FROM mlm_members WHERE id = '$member'"))['tan_bal'];
			if($tan_bal >= $amount){
				$db->insert($req_sql);
				header('Location:cash.php?mode='.$mode.'&member='.$member.'&success=Request Sent');
			}else{
				header('Location:cash.php?mode='.$mode.'&member='.$member.'&error=Not Enough Balance');
			}
		}
	}

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cashTan'])){
		$amount = $_POST['amount'];
		$totalamount = $amount*1.1;
		$vat = $totalamount-$amount;
		$balance = (mysqli_fetch_array($db->select("SELECT balance FROM mlm_members where id = '$member'"))['balance']);
		if($totalamount > $balance){
			header('Location:cash.php?mode='.$mode.'&member='.$member.'&error=Not Enough Balance');
		}else{
			if(
				$db->update("UPDATE mlm_members SET balance = balance - '$totalamount' , tan_bal = tan_bal + '$amount' WHERE id = '$member'")
				&&
				$db->update("UPDATE mlm_users SET vat = vat + '$vat' WHERE id = 1 ")
			){
				header('Location:cash.php?mode='.$mode.'&member='.$member.'&success=Balance Transferred');
			}
		}
	}
?>