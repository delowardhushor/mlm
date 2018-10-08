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

			if ($db->update($generation_sql)){
				$generation = $generation-1;
			}

			if($generation == 0){
				break;
			}
		}

		calc_board_commission($id+1, $db);
	}

	function calc_board_commission($id, $db){

		$sql = "SELECT * FROM mlm_members ORDER BY 'id' ASC";

		$result = $db->select($sql);

		$member_serial = 1;

		$total_members = $result->num_rows;

		if ($result && $total_members > 0) {
            while($row = $result->fetch_assoc()) {
            	$x = $member_serial+($member_serial*5);
            	if($x <= $total_members  && $row['got500'] == 0 )
            	{
            		$id = $row['id'];
            		$add_got500_sql = "UPDATE mlm_members SET balance = balance + 500 , got500 = 1 WHERE id = '$id'";
					$db->update($add_got500_sql);	
            	}
            	elseif($x*$x <= $total_members  && $row['got1000'] == 0 )
            	{
            		$id = $row['id'];
            		$add_got1000_sql = "UPDATE mlm_members SET balance = balance + 1000 , got1000 = 1 WHERE id = '$id'";
					$db->update($add_got1000_sql);
            	}
            	elseif($x*$x*$x <= $total_members  && $row['got2000'] == 0 )
            	{
            		$id = $row['id'];
            		$add_got2000_sql = "UPDATE mlm_members SET balance = balance + 2000 , got2000 = 1 WHERE id = '$id'";
					$db->update($add_got2000_sql);
            	}
            	elseif($x*$x*$x*$x <= $total_members  && $row['got3000'] == 0 )
            	{
            		$id = $row['id'];
            		$add_got3000_sql = "UPDATE mlm_members SET balance = balance + 3000 , got3000 = 1 WHERE id = '$id'";
					$db->update($add_got3000_sql);
            	}
            	elseif($x*$x*$x*$x*$x <= $total_members  && $row['got4000'] == 0 )
            	{
            		$id = $row['id'];
            		$add_got4000_sql = "UPDATE mlm_members SET balance = balance + 4000 , got4000 = 1 WHERE id = '$id'";
					$db->update($add_got4000_sql);
            	}
            	elseif($x*$x*$x*$x*$x*$x <= $total_members  && $row['got5000'] == 0 )
            	{
            		$id = $row['id'];
            		$add_got5000_sql = "UPDATE mlm_members SET balance = balance + 5000 , got5000 = 1 WHERE id = '$id'";
					$db->update($add_got5000_sql);
            	}
            	elseif($x*$x*$x*$x*$x*$x*$x <= $total_members  && $row['got6000'] == 0 )
            	{
            		$id = $row['id'];
            		$add_got6000_sql = "UPDATE mlm_members SET balance = balance + 6000 , got6000 = 1 WHERE id = '$id'";
					$db->update($add_got6000_sql);
            	}
            	elseif($x*$x*$x*$x*$x*$x*$x*$x <= $total_members  && $row['got7000'] == 0 )
            	{
            		$id = $row['id'];
            		$add_got7000_sql = "UPDATE mlm_members SET balance = balance + 7000 , got7000 = 1 WHERE id = '$id'";
					$db->update($add_got7000_sql);
            	}

            	$member_serial = $member_serial+1;
            }
            header("Location:../members.php");
        } 

		// for($i = 0; $i < $id; $i++){

		// 	$sql = "SELECT * FROM mlm_members WHERE id = '$i' LIMIT 1 ";

		//     $result = $db->select($sql);

		//     if ($result != false) {
		// 	    $value = mysqli_fetch_array($result);
		// 	    $row = mysqli_num_rows($result);
		// 	    if ($row > 0 ) {

		// 	    }
		// 	}

		// 	$add_child_sql = "UPDATE mlm_members SET child = child + 1 WHERE id = '$i'";
		// 	$db->update($add_child_sql);
		// }
	}
?>