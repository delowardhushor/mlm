<?php
	include 'allhelper.php';

	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$name = $_POST['name'];
		$parent_member = $_POST['parent_member'];
		$package = $_POST['package'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$pass = md5($_POST['pass']);
		$usertype = $_POST['usertype'];

		$chkUser = $db->select("SELECT count(*) FROM mlm_members WHERE email = '$email'");
		if(mysqli_fetch_array($chkUser)['count(*)'] > 0){
			//Header('Location:../member.php?error=Username Exist');
			echo "<script>window.location ='../members.php?error=Username Exist';</script>";
			die();
		}

		$sql_member_blance = "SELECT * FROM mlm_members WHERE id = '$parent_member' LIMIT 1 ";
		$package_sql_balance = "SELECT * FROM mlm_packages WHERE id = '$package' LIMIT 1 ";

	    $result_member_blance = $db->select($sql_member_blance);
	    $row_mem_bal = mysqli_fetch_array($result_member_blance);

	    $package_result_member_blance = $db->select($package_sql_balance);
	    $row_pak_price = mysqli_fetch_array($package_result_member_blance);


		if($usertype == 'admin'){
			$sql = "INSERT INTO mlm_members (name, parent_member, email, pass, package, phone) VALUES ('$name', '$parent_member', '$email', '$pass', '$package', '$phone')";

			$db->update("UPDATE mlm_users SET balance = balance + 150,  gen_bal = gen_bal + 175, board_bal = board_bal + 300, id_bal = id_bal + 175 WHERE id = 1");

			if ($db->insert($sql)) {

				$last_member = $db->link->insert_id;

				$db->insert("INSERT INTO mlm_income (member) VALUES ('$last_member')");

				$package_income = $row_pak_price['price'] - $row_pak_price['cost'] - 1000;
				$db->update("UPDATE mlm_users SET account = account + '$package_income' WHERE id = 1");

				update_parent($parent_member, $usertype, $package , $db->link->insert_id-1, $db);

				//Header('Location:../members.php?success=Member Added');
				echo "<script>window.location ='../members.php?success=Member Added';</script>";

			}else{
				//Header('Location:../member.php?error=Member Not Added');
				echo "<script>window.location ='../members.php?error=Member Not Added';</script>";
			} 

		}elseif($row_mem_bal['tan_bal'] >= $row_pak_price['price']){
			$sql = "INSERT INTO mlm_members (name, parent_member, email, pass, package, phone) VALUES ('$name', '$parent_member', '$email', '$pass', '$package', '$phone')";

			if ($db->insert($sql)) {

				$last_member = $db->link->insert_id;

				$db->insert("INSERT INTO mlm_income (member) VALUES ('$last_member')");

				$package_income = $row_pak_price['price'] - $row_pak_price['cost'] - 1000;
				$db->update("UPDATE mlm_users SET balance = balance + 150,  gen_bal = gen_bal + 175, board_bal = board_bal + 300, id_bal = id_bal + 175, account = account + '$package_income' WHERE id = 1");

				update_parent($parent_member, $usertype, $package , $db->link->insert_id-1, $db);

				//Header('Location:../members.php?success=Member Added');
				echo "<script>window.location ='../dashboard.php?success=Member Added';</script>";

			}else{
				//Header('Location:../member.php?error=Member Not Added');
				echo "<script>window.location ='../dashboard.php?error=Member Not Added';</script>";
			} 
		}else{
			//Header('Location:../member.php?error=You dont have Enough Balance');
			echo "<script>window.location ='../dashboard.php?error=You dont Have Enough Balance';</script>";
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
	      	$update_sql = "UPDATE mlm_members SET balance = balance+200, tan_bal = tan_bal-'$price',  referred = '$referred' , rank = '$rank' WHERE id = '$id' ";
	      }

	      $db->update("UPDATE mlm_income SET by_refer = by_refer+200 WHERE member = '$id' ");
	      $db->insert("INSERT INTO mlm_comhis (member, com_by, amount) VALUES ('$id', 'Reference', 200) ");

	      if($db->update($update_sql)){
	      	calc_rank($id, $db);
	      }
	  	}
	}

	function calc_rank($id, $db){
		$sql_silver = "SELECT id FROM mlm_members WHERE rank = 'Silver' ";
		$result_silver = $db->select($sql_silver);
		$numberOFRank = 0;
		if($result_silver){
			$numberOFRank = $numberOFRank+1;
			$add_silver = 45/$result_silver->num_rows;
			$db->update("UPDATE mlm_members SET balance = balance + $add_silver WHERE rank = 'Silver' ");

            while($row_silver = $result_silver->fetch_assoc()) {
            	$silver_id = $row_silver['id'];
            	$db->update("UPDATE mlm_income SET by_rank = by_rank + $add_silver WHERE member = '$silver_id' ");
            	$db->insert("INSERT INTO mlm_rank (sil) VALUES ('$add_silver')");
            	$db->insert("INSERT INTO mlm_comhis (member, com_by, amount) VALUES ('$silver_id', 'Rank', '$add_silver') ");
            }
		}
		

		$sql_gold = "SELECT id FROM mlm_members WHERE rank = 'Gold' ";
		$result_gold = $db->select($sql_gold);
		if($result_gold){
			$numberOFRank = $numberOFRank+1;
			$add_gold = 45/$result_gold->num_rows;
			$db->update("UPDATE mlm_members SET balance = balance + $add_gold WHERE rank = 'Gold' ");

			while($row_gold = $result_gold->fetch_assoc()) {
            	$gold_id = $row_gold['id'];
            	$db->update("UPDATE mlm_income SET by_rank = by_rank + $add_gold WHERE member = '$gold_id' ");
            	$db->insert("INSERT INTO mlm_rank (gol) VALUES ('$add_gold')");
            	$db->insert("INSERT INTO mlm_comhis (member, com_by, amount) VALUES ('$gold_id', 'Rank', '$add_gold') ");
            }
		}

		$sql_platinum = "SELECT id FROM mlm_members WHERE rank = 'Platinum' ";
		$result_platinum = $db->select($sql_platinum);
		if($result_platinum){
			$numberOFRank = $numberOFRank+1;
			$add_platinum = 45/$result_platinum->num_rows;
			$db->update("UPDATE mlm_members SET balance = balance + $add_platinum WHERE rank = 'Platinum' ");

			while($row_platinum = $result_platinum->fetch_assoc()) {
            	$platinum_id = $row_platinum['id'];
            	$db->update("UPDATE mlm_income SET by_rank = by_rank + $add_platinum WHERE member = '$platinum_id' ");
            	$db->insert("INSERT INTO mlm_rank (pla) VALUES ('$add_platinum')");
            	$db->insert("INSERT INTO mlm_comhis (member, com_by, amount) VALUES ('$platinum_id', 'Rank', '$add_platinum') ");
            }
		}

		$lessRankBalance = $numberOFRank*45;

		$db->Update("UPDATE mlm_users SET balance = balance - $lessRankBalance WHERE id = 1 ");

		//print_r($value);
		//calc_generation((mysqli_fetch_array($db->select("SELECT parent_member FROM mlm_members WHERE id = '$id' LIMIT 1")))['parent_member'], $db, 15);

		get_gen_id($id, 1, [$id], $db);

		
	}

	function get_gen_id($id, $count, $gotten_id, $db){
		if($id == 1 || $count == 15){
			cal_gen($gotten_id, $db);
		}else{
			$result = $db->select("SELECT parent_member FROM mlm_members WHERE id = '$id'");
			if($result){
				$parent_id = (mysqli_fetch_array($result))['parent_member'];
				$gotten_id[] = $parent_id;
				get_gen_id($parent_id, $count+1, $gotten_id, $db);
			}else{
				cal_gen($gotten_id, $db);
			}
		}
	}

	function cal_gen($gotten_id, $db){
		//$revese_id = array_reverse($gotten_id);
		$revese_id = $gotten_id;

		for($generation=0; $generation < count($revese_id); $generation++ ){
			$id = $revese_id[$generation];
			$commission = 0;
			if(10 <= $generation && $generation <= 14){
				$commission = 5;
			}elseif(5 <= $generation && $generation <= 9){
				$commission = 10;
			}elseif(0 <= $generation && $generation <= 4){
				$commission = 20;
			}

			if($id != 0){

				$db->update("UPDATE mlm_members SET balance = balance + '$commission' WHERE id = '$id'");
				$gen_level = sizeof($revese_id)-$generation;

				$db->insert("INSERT INTO mlm_genhis (member, amount, gen) VALUES ('$id', '$commission', $generation+1)");

				$db->update("UPDATE mlm_income SET by_generation = by_generation + '$commission' WHERE member = '$id' ");

				$db->insert("INSERT INTO mlm_comhis (member, com_by, amount) VALUES ('$id', 'Generation', '$commission') ");

				$db->update("UPDATE mlm_users SET gen_bal = gen_bal - '$commission' WHERE id = 1");
			}

		}

		calc_board_500($db);
	}

	function calc_board_500($db){

		$sql = "SELECT * FROM mlm_members ORDER BY id ASC";
		$result = $db->select($sql);
		$total_members = $result->num_rows;
		$id = ($total_members-1)/5;
		if(!is_float($id)){
			$generation_sql = "UPDATE mlm_members SET balance = balance + 500, got500 = '1' WHERE id = '$id' ";
			$db->update("UPDATE mlm_income SET by_board = by_board + 500 WHERE member = '$id' ");
			$db->insert("INSERT INTO mlm_comhis (member, com_by, amount) VALUES ('$id', 'Board', 500) ");
			if ($db->update($generation_sql) && mysqli_affected_rows($db->link) > 0){
				$db->update("UPDATE mlm_users SET board_bal = board_bal - 500 WHERE id = 1");
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
			$db->insert("INSERT INTO mlm_comhis (member, com_by, amount) VALUES ('$id', 'Board', 1000) ");
			if ($db->update($generation_sql) && mysqli_affected_rows($db->link) > 0){
				$db->update("UPDATE mlm_users SET board_bal = board_bal - 1000 WHERE id = 1");
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
			$db->insert("INSERT INTO mlm_comhis (member, com_by, amount) VALUES ('$id', 'Board', 2000) ");
			if ($db->update($generation_sql) && mysqli_affected_rows($db->link) > 0){
				$db->update("UPDATE mlm_users SET board_bal = board_bal - 2000 WHERE id = 1");
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
			$db->insert("INSERT INTO mlm_comhis (member, com_by, amount) VALUES ('$id', 'Board', 5000) ");
			if ($db->update($generation_sql) && mysqli_affected_rows($db->link) > 0){
				$db->update("UPDATE mlm_users SET board_bal = board_bal - 5000 WHERE id = 1");
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
			$generation_sql = "UPDATE mlm_members SET balance = balance + 15000, got4000 = '1' WHERE id = '$id' ";
			$db->update("UPDATE mlm_income SET by_board = by_board + 15000 WHERE member = '$id' ");
			$db->insert("INSERT INTO mlm_comhis (member, com_by, amount) VALUES ('$id', 'Board', 15000) ");
			if ($db->update($generation_sql) && mysqli_affected_rows($db->link) > 0){
				$db->update("UPDATE mlm_users SET board_bal = board_bal - 15000 WHERE id = 1");
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
			$generation_sql = "UPDATE mlm_members SET balance = balance + 50000, got5000 = '1' WHERE id = '$id' ";
			$db->update("UPDATE mlm_income SET by_board = by_board + 50000 WHERE member = '$id' ");
			$db->insert("INSERT INTO mlm_comhis (member, com_by, amount) VALUES ('$id', 'Board', 50000) ");
			if ($db->update($generation_sql) && mysqli_affected_rows($db->link) > 0){
				$db->update("UPDATE mlm_users SET board_bal = board_bal - 50000 WHERE id = 1");
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
			$generation_sql = "UPDATE mlm_members SET balance = balance + 500000, got6000 = '1' WHERE id = '$id' ";
			$db->update("UPDATE mlm_income SET by_board = by_board + 500000 WHERE member = '$id' ");
			$db->insert("INSERT INTO mlm_comhis (member, com_by, amount) VALUES ('$id', 'Board', 500000) ");
			if ($db->update($generation_sql) && mysqli_affected_rows($db->link) > 0){
				$db->update("UPDATE mlm_users SET board_bal = board_bal - 500000 WHERE id = 1");
				//header('Location:../members.php?success=Member Added');
				echo "<script>window.location ='../members.php?success=Member Added';</script>";
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