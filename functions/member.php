<?php
	include 'allhelper.php';

	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$name = $_POST['name'];
		$parent_member = $_POST['parent_member'];
		$package = $_POST['package'];
		$email = $_POST['email'];
		$pass = md5($_POST['pass']);
		$usertype = $_POST['usertype'];

		$sql_member_blance = "SELECT * FROM mlm_members WHERE id = '$parent_member' LIMIT 1 ";
		$package_sql_balance = "SELECT * FROM mlm_packages WHERE id = '$package' LIMIT 1 ";

	    $result_member_blance = $db->select($sql_member_blance);
	    $row_mem_bal = mysqli_fetch_array($result_member_blance);

	    $package_result_member_blance = $db->select($package_sql_balance);
	    $row_pak_price = mysqli_fetch_array($package_result_member_blance);


		if($usertype == 'admin'){

			$update_package = "UPDATE mlm_packages set stock = stock -1 WHERE id = '$package' ";
			$sql = "INSERT INTO mlm_members (name, parent_member, email, pass, package) VALUES ('$name', '$parent_member', '$email', '$pass', '$package')";

			$db->update("UPDATE mlm_users SET balance = balance + 150,  gen_bal = gen_bal + 175, board_bal = board_bal + 300, id_bal = id_bal + 175");

			if ($db->update($update_package) && $db->insert($sql)) {

				$last_member = $db->link->insert_id;

				$db->insert("INSERT INTO mlm_income (member) VALUES ('$last_member')");

				update_parent($parent_member, $usertype, $package , $db->link->insert_id-1, $db);

				Header('Location:../member.php?success=Member Added');

			}else{
				Header('Location:../member.php?error=Member Not Added');
			} 

		}elseif($row_mem_bal['balance'] >= $row_pak_price['price']){
			$update_package = "UPDATE mlm_packages set stock = stock -1 WHERE id = '$package' ";
			$sql = "INSERT INTO mlm_members (name, parent_member, email, pass, package) VALUES ('$name', '$parent_member', '$email', '$pass', '$package')";

			if ($db->update($update_package) && $db->insert($sql)) {

				$last_member = $db->link->insert_id;

				$db->insert("INSERT INTO mlm_income (member) VALUES ('$last_member')");

				update_parent($parent_member, $usertype, $package , $db->link->insert_id-1, $db);

				Header('Location:../member.php?success=Member Added');

			}else{
				Header('Location:../member.php?error=Member Not Added');
			} 
		}else{
			Header('Location:../member.php?error=You dont have Enough Balance');
		}
	}

	function update_parent($id, $usertype , $package, $latest_id, $db){

		//$db->update("UPDATE mlm_users SET balance = balance + 15 WHERE id = 1 ");

		$sql = "SELECT * FROM mlm_members WHERE id = '$id' LIMIT 1 ";
		$package_sql = "SELECT * FROM mlm_packages WHERE id = '$package' LIMIT 1 ";

	    $result = $db->select($sql);

	    $package_result = $db->select($package_sql);

	    if ($result != false && $package_result != false) {
	      $value = mysqli_fetch_array($result);
	      $package_value = mysqli_fetch_array($package_result);
	      $price = $package_value['price'];
	      $rank = 'none';
	      $referred = $value['referred']+1;
	      if( 5 <= $referred && $referred <= 19 ){
	      	$rank = 'Silver';
	      }elseif(20 <= $referred && $referred <= 49){
	      	$rank = 'Gold';
	      }elseif(50 <= $referred){
	      	$rank = 'Platinum';
	      }

	      $update_sql = "UPDATE mlm_members SET balance = balance+200,  referred = '$referred' , rank = '$rank' WHERE id = '$id' ";

	      if($usertype == 'member'){
	      	$update_sql = "UPDATE mlm_members SET balance = balance+200-'$price',  referred = '$referred' , rank = '$rank' WHERE id = '$id' ";
	      }

	      $db->update("UPDATE mlm_income SET by_refer = by_refer+200 WHERE member = '$id' ");

	      if($db->update($update_sql)){
	      	calc_rank($id, $db);
	      }
	  	}
	}

	function calc_rank($id, $db){
		$sql_silver = "SELECT id FROM mlm_members WHERE rank = 'Silver' ";
		$result_silver = $db->select($sql_silver);
		$numberOFRank = 0;
		if($result_silver->num_rows > 0){
			$numberOFRank = $numberOFRank+1;
			$add_silver = 45/$result_silver->num_rows;
			$db->update("UPDATE mlm_members SET balance = balance + $add_silver WHERE rank = 'Silver' ");

            while($row_silver = $result_silver->fetch_assoc()) {
            	$silver_id = $row_silver['id'];
            	$db->update("UPDATE mlm_income SET by_rank = by_rank + $add_silver WHERE member = '$silver_id' ");
            }
		}
		

		$sql_gold = "SELECT id FROM mlm_members WHERE rank = 'Gold' ";
		$result_gold = $db->select($sql_gold);
		if($result_gold->num_rows > 0){
			$numberOFRank = $numberOFRank+1;
			$add_gold = 45/$result_gold->num_rows;
			$db->update("UPDATE mlm_members SET balance = balance + $add_gold WHERE rank = 'Gold' ");

			while($row_gold = $result_gold->fetch_assoc()) {
            	$gold_id = $row_gold['id'];
            	$db->update("UPDATE mlm_income SET by_rank = by_rank + $add_gold WHERE member = '$gold_id' ");
            }
		}

		$sql_platinum = "SELECT id FROM mlm_members WHERE rank = 'Platinum' ";
		$result_platinum = $db->select($sql_platinum);
		if($result_platinum->num_rows > 0){
			$numberOFRank = $numberOFRank+1;
			$add_platinum = 45/$result_platinum->num_rows;
			$db->update("UPDATE mlm_members SET balance = balance + $add_platinum WHERE rank = 'Platinum' ");

			while($row_platinum = $result_platinum->fetch_assoc()) {
            	$platinum_id = $row_platinum['id'];
            	$db->update("UPDATE mlm_income SET by_rank = by_rank + $add_platinum WHERE member = '$platinum_id' ");
            }
		}

		$lessRankBalance = $numberOFRank*45;

		$db->Update("UPDATE mlm_users SET balance = balance - $lessRankBalance WHERE id = 1 ");

		//print_r($value);
		calc_generation((mysqli_fetch_array($db->select("SELECT parent_member FROM mlm_members WHERE id = '$id' LIMIT 1")))['parent_member'], $db, 15);
	}

	function calc_generation($id, $db, $generation){

		$commission = 0;
		if(11 <= $generation && $generation <= 15){
			$commission = 5;
		}elseif(6 <= $generation && $generation <= 10){
			$commission = 10;
		}elseif(1 <= $generation && $generation <= 5){
			$commission = 20;
		}

		$db->update("UPDATE mlm_members SET balance = balance + '$commission' WHERE id = '$id'");

		$db->update("UPDATE mlm_income SET by_generation = by_generation + '$commission' WHERE member = '$id' ");

		$db->update("UPDATE mlm_users SET gen_bal = gen_bal - '$commission' WHERE id = 1");

		$generation = $generation-1;

		if($generation == 0 || $id == 1){
			calc_board_500($db);
		}else{
			calc_generation((mysqli_fetch_array($db->select("SELECT parent_member FROM mlm_members WHERE id = '$id' LIMIT 1")))['parent_member'], $db, $generation);
		}

		
	}

	function calc_board_500($db){

		$sql = "SELECT * FROM mlm_members ORDER BY id ASC";
		$result = $db->select($sql);
		$total_members = $result->num_rows;
		$id = ($total_members-1)/5;
		if(!is_float($id)){
			$generation_sql = "UPDATE mlm_members SET balance = balance + 500, got500 = '1' WHERE id = '$id' ";
			$db->update("UPDATE mlm_income SET by_board = by_board + 500 WHERE member = '$id' ");
			if ($db->update($generation_sql) && mysqli_affected_rows($db->link) > 0){
				$db->update("UPDATE mlm_Users SET board_bal = board_bal - 500 WHERE id = 1");
				calc_board_1000($db);
			}
		}
	}

	function calc_board_1000($db){
		$sql = "SELECT * FROM mlm_members WHERE got500 = '1' ORDER BY id ASC";
		$result = $db->select($sql);
		$total_members = $result->num_rows;
		$id = ($total_members-1)/5;
		if(!is_float($id)){
			$generation_sql = "UPDATE mlm_members SET balance = balance + 1000, got1000 = '1' WHERE id = '$id' ";
			$db->update("UPDATE mlm_income SET by_board = by_board + 1000 WHERE member = '$id' ");
			if ($db->update($generation_sql) && mysqli_affected_rows($db->link) > 0){
				$db->update("UPDATE mlm_Users SET board_bal = board_bal - 1000 WHERE id = 1");
				calc_board_2000($db);
			}
		}
	}

	function calc_board_2000($db){
		$sql = "SELECT * FROM mlm_members WHERE got1000 = '1' ORDER BY id ASC";
		$result = $db->select($sql);
		$total_members = $result->num_rows;
		$id = ($total_members-1)/5;
		if(!is_float($id)){
			$generation_sql = "UPDATE mlm_members SET balance = balance + 2000, got2000 = '1' WHERE id = '$id' ";
			$db->update("UPDATE mlm_income SET by_board = by_board + 2000 WHERE member = '$id' ");
			if ($db->update($generation_sql) && mysqli_affected_rows($db->link) > 0){
				$db->update("UPDATE mlm_Users SET board_bal = board_bal - 2000 WHERE id = 1");
				calc_board_3000($db);
			}
		}	
	}

	function calc_board_3000($db){
		$sql = "SELECT * FROM mlm_members WHERE got2000 = '1' ORDER BY id ASC";
		$result = $db->select($sql);
		$total_members = $result->num_rows;
		$id = ($total_members-1)/5;
		if(!is_float($id)){
			$generation_sql = "UPDATE mlm_members SET balance = balance + 5000, got3000 = '1' WHERE id = '$id' ";
			$db->update("UPDATE mlm_income SET by_board = by_board + 5000 WHERE member = '$id' ");
			if ($db->update($generation_sql) && mysqli_affected_rows($db->link) > 0){
				$db->update("UPDATE mlm_Users SET board_bal = board_bal - 5000 WHERE id = 1");
				calc_board_4000($db);
			}
		}
	}

	function calc_board_4000($db){
		$sql = "SELECT * FROM mlm_members WHERE got3000 = '1' ORDER BY id ASC";
		$result = $db->select($sql);
		$total_members = $result->num_rows;
		$id = ($total_members-1)/5;
		if(!is_float($id)){
			$generation_sql = "UPDATE mlm_members SET balance = balance + 10000, got4000 = '1' WHERE id = '$id' ";
			$db->update("UPDATE mlm_income SET by_board = by_board + 10000 WHERE member = '$id' ");
			if ($db->update($generation_sql) && mysqli_affected_rows($db->link) > 0){
				$db->update("UPDATE mlm_Users SET board_bal = board_bal - 10000 WHERE id = 1");
				calc_board_5000($db);
			}
		}
	}

	function calc_board_5000($db){
		$sql = "SELECT * FROM mlm_members WHERE got4000 = '1' ORDER BY id ASC";
		$result = $db->select($sql);
		$total_members = $result->num_rows;
		$id = ($total_members-1)/5;
		if(!is_float($id)){
			$generation_sql = "UPDATE mlm_members SET balance = balance + 20000, got5000 = '1' WHERE id = '$id' ";
			$db->update("UPDATE mlm_income SET by_board = by_board + 20000 WHERE member = '$id' ");
			if ($db->update($generation_sql) && mysqli_affected_rows($db->link) > 0){
				$db->update("UPDATE mlm_Users SET board_bal = board_bal - 20000 WHERE id = 1");
				calc_board_6000($db);
			}
		}
	}

	function calc_board_6000($db){
		$sql = "SELECT * FROM mlm_members WHERE got5000 = '1' ORDER BY id ASC";
		$result = $db->select($sql);
		$total_members = $result->num_rows;
		$id = ($total_members-1)/5;
		if(!is_float($id)){
			$generation_sql = "UPDATE mlm_members SET balance = balance + 50000, got6000 = '1' WHERE id = '$id' ";
			$db->update("UPDATE mlm_income SET by_board = by_board + 50000 WHERE member = '$id' ");
			if ($db->update($generation_sql) && mysqli_affected_rows($db->link) > 0){
				$db->update("UPDATE mlm_Users SET board_bal = board_bal - 50000 WHERE id = 1");
				header('Location:../member.php?success=Member Added');
			}
		}
	}

	// function calc_board_7000($db){
	// 	$sql = "SELECT * FROM mlm_members WHERE got6000 = '1' ORDER BY id ASC";
	// 	$result = $db->select($sql);
	// 	$total_members = $result->num_rows;
	// 	$id = ($total_members-1)/5;
	// 	if(!is_float($id)){
	// 		$generation_sql = "UPDATE mlm_members SET balance = balance + 7000, got7000 = '1' WHERE id = '$id' ";
	// 		$db->update("UPDATE mlm_income SET by_board = by_board + 7000 WHERE member = '$id' ");
	// 		if ($db->update($generation_sql) && mysqli_affected_rows($db->link) > 0){
	// 			$db->update("UPDATE mlm_Users SET board_bal = board_bal - 500 WHERE id = 1");
	// 			header('Location:../member.php?success=Member Added');
	// 		}
	// 	}
	// }
?>