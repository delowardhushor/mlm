<?php
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cashRequest'])){
		$amount = $_POST['amount'];
		$mobile_from = $_POST['mobile_from'];
		$tan_id = $_POST['tan_id'];
		$pay_type = $_POST['pay_type'];
		// $transaction_number = $_POST['transaction_number'];
		// $sent_mobile = $_POST['sent_mobile'];
		$req_sql = "INSERT INTO mlm_cashout (member, amount, mode, mobile_from, tan_id, pay_type) VALUES ('$member', '$amount','$mode', '$mobile_from', '$tan_id', '$pay_type')";
		if($mode == 'in'){
			
			$req_sql = "INSERT INTO mlm_cashout (member, amount, mode, mobile_from, tan_id, pay_type) VALUES ('$member', '$amount', '$mode', '$mobile_from', '$tan_id', '$pay_type')";
			$db->insert($req_sql);
			//header('Location:cash.php?mode='.$mode.'&member='.$member.'&success=Request Sent');
			echo "<script>window.location ='cash.php?mode=".$mode."&member=".$member."&success=Request Sent';</script>";
		}else{
			$balance = mysqli_fetch_array($db->select("SELECT balance FROM mlm_members WHERE id = '$member'"))['balance'];
			if($balance >= $amount*1.1){
				$db->insert($req_sql);
				//header('Location:cash.php?mode='.$mode.'&member='.$member.'&success=Request Sent');
				echo "<script>window.location ='cash.php?mode=".$mode."&member=".$member."&success=Request Sent';</script>";
			}else{
				//header('Location:cash.php?mode='.$mode.'&member='.$member.'&error=Not Enough Balance');
				echo "<script>window.location ='cash.php?mode=".$mode."&member=".$member."&error=Not Enough Balance';</script>";
			}
		}
	}

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cashTan'])){
		$amount = $_POST['amount'];
		$totalamount = $amount*1.1;
		$vat = $totalamount-$amount;
		$balance = (mysqli_fetch_array($db->select("SELECT balance FROM mlm_members where id = '$member'"))['balance']);
		if($totalamount > $balance){
			//header('Location:cash.php?mode='.$mode.'&member='.$member.'&error=Not Enough Balance');
			echo "<script>window.location ='cash.php?mode=".$mode."&member=".$member."&error=Not Enough Balance';</script>";
		}else{
			if(
				$db->update("UPDATE mlm_members SET balance = balance - '$totalamount' , tan_bal = tan_bal + '$amount' WHERE id = '$member'")
				&&
				$db->update("UPDATE mlm_users SET vat = vat + '$vat' WHERE id = 1 ")
			){
				//header('Location:cash.php?mode='.$mode.'&member='.$member.'&success=Balance Transferred');
				echo "<script>window.location ='cash.php?mode=".$mode."&member=".$member."&success=Balance Transferred';</script>";
			}
		}
	}
?>