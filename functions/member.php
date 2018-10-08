<?php
	include 'allhelper.php';

	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$name = $_POST['name'];
		$parent_member = $_POST['parent_member'];

		$sql = "INSERT INTO mlm_members (name, parent_member) VALUES ('$name', '$parent_member')";
		$parent_sql =  "UPDATE mlm_members SET balance = balance + 200 WHERE id = '$parent_member'";
		if ($db->update($parent_sql) && $db->insert($sql)) {

			calc_generation($db->link->insert_id-1, $db);

		} 
	}

	function calc_generation($id, $db){

		$generation = 15;

		for($i = $id; $i > 0; $i--){
			$commission = 0;
			if(11 <= $generation && $generation <= 15){
				$commission = 20;
			}elseif(6 <= $generation && $generation <= 10){
				$commission = 10;
			}elseif(1 <= $generation && $generation <= 5){
				$commission = 5;
			}

			$generation_sql = "UPDATE mlm_members SET balance = balance + '$commission' WHERE id = '$i'";

			if ($db->update($generation_sql) && mysqli_affected_rows($db->link) > 0){
				$generation = $generation-1;
			}

			if($generation == 0){
				break;
			}
		}

		calc_board_500($db);
	}

	function calc_board_500($db){

		$sql = "SELECT * FROM mlm_members ORDER BY id ASC";
		$result = $db->select($sql);
		$total_members = $result->num_rows;
		$id = ($total_members-1)/5;
		echo $id;
		if(!is_float($id)){
			$generation_sql = "UPDATE mlm_members SET balance = balance + 500, got500 = '1' WHERE id = '$id' ";
			if ($db->update($generation_sql) && mysqli_affected_rows($db->link) > 0){
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
			if ($db->update($generation_sql) && mysqli_affected_rows($db->link) > 0){
				calc_board_2000($db);
			}
		}
	}

	function calc_board_2000($db){
		$sql = "SELECT * FROM mlm_members WHERE got1000 = '1' ORDER BY id DESC";
		$result = $db->select($sql);
		$total_members = $result->num_rows;
		$id = ($total_members-1)/5;
		if(!is_float($id)){
			$generation_sql = "UPDATE mlm_members SET balance = balance + 2000, got2000 = '1' WHERE id = '$id' ";
			if ($db->update($generation_sql) && mysqli_affected_rows($db->link) > 0){
				calc_board_3000($db);
			}
		}	
	}

	function calc_board_3000($db){
		$sql = "SELECT * FROM mlm_members WHERE got2000 = '1' ORDER BY id DESC";
		$result = $db->select($sql);
		$total_members = $result->num_rows;
		$id = ($total_members-1)/5;
		if(!is_float($id)){
			$generation_sql = "UPDATE mlm_members SET balance = balance + 3000, got3000 = '1' WHERE id = '$id' ";
			if ($db->update($generation_sql) && mysqli_affected_rows($db->link) > 0){
				calc_board_4000($db);
			}
		}
	}

	function calc_board_4000($db){
		$sql = "SELECT * FROM mlm_members WHERE got3000 = '1' ORDER BY id DESC";
		$result = $db->select($sql);
		$total_members = $result->num_rows;
		$id = ($total_members-1)/5;
		if(!is_float($id)){
			$generation_sql = "UPDATE mlm_members SET balance = balance + 4000, got4000 = '1' WHERE id = '$id' ";
			if ($db->update($generation_sql) && mysqli_affected_rows($db->link) > 0){
				calc_board_5000($db);
			}
		}
	}

	function calc_board_5000($db){
		$sql = "SELECT * FROM mlm_members WHERE got4000 = '1' ORDER BY id DESC";
		$result = $db->select($sql);
		$total_members = $result->num_rows;
		$id = ($total_members-1)/5;
		if(!is_float($id)){
			$generation_sql = "UPDATE mlm_members SET balance = balance + 5000, got5000 = '1' WHERE id = '$id' ";
			if ($db->update($generation_sql) && mysqli_affected_rows($db->link) > 0){
				calc_board_6000($db);
			}
		}
	}

	function calc_board_6000($db){
		$sql = "SELECT * FROM mlm_members WHERE got5000 = '1' ORDER BY 'id' DESC";
		$result = $db->select($sql);
		$total_members = $result->num_rows;
		$id = ($total_members-1)/5;
		if(!is_float($id)){
			$generation_sql = "UPDATE mlm_members SET balance = balance + 6000, got6000 = '1' WHERE id = '$id' ";
			if ($db->update($generation_sql) && mysqli_affected_rows($db->link) > 0){
				calc_board_7000($db);
			}
		}
	}

	function calc_board_7000($db){
		$sql = "SELECT * FROM mlm_members WHERE got6000 = '1' ORDER BY 'id' DESC";
		$result = $db->select($sql);
		$total_members = $result->num_rows;
		$id = ($total_members-1)/5;
		if(!is_float($id)){
			$generation_sql = "UPDATE mlm_members SET balance = balance + 7000, got7000 = '1' WHERE id = '$id' ";
			if ($db->update($generation_sql) && mysqli_affected_rows($db->link) > 0){
				//echo "done";
			}
		}
	}
?>