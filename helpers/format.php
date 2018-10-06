
<?php



class format{
	public function formatDate($date){
		return date('F j, Y', strtotime($date));
	}
	public function postShorten($text, $limit= 400){
		$text = $text." ";
		$text = substr($text , 0, $limit);
		$text = substr($text , 0, strrpos($text, ' '));
		$text= $text. "....";
		return $text;
	}

	public function validation($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;	}

	public function chk_exist_order_catagory($catagory_name){
		$query = "select * from order_catagory where catgory_name= '$catagory_name'";
		$result= $db->select($query);
		if ($result) {
			return $result;
		}else{
			return false;
		}
	}

	public function chk_exist_income_catagory($name){
		$query = "select * from income_catagory where name= '$name'";
		$result= $db->select($query);
		if ($result) {
			return $result;
		}else{
			return false;
		}
	}


	public function chk_exist_expense_catagory($name){
		$query = "select * from expense_catagory where name= '$name'";
		$result= $db->select($query);
		if ($result) {
			return $result;
		}else{
			return false;
		}
	}


	public function title(){
		$path = $_SERVER['SCRIPT_FILENAME'];
		$title = basename($path , '.php');
		$title = str_replace('_' , ' ', $title );
		$title = str_replace('-' , ' ', $title );
		if ($title == 'index') {
			$title = 'home';
		}elseif ($title == 'contact') {
			$title = 'contact';
		}return $title = ucwords($title);
	}

	
    public function number_format($n){
    	 if($n>1000000000000) return round(($n/1000000000000),1).' T';
        else if($n>1000000000) return round(($n/1000000000),1).' B';
        else if($n>1000000) return round(($n/1000000),1).' M';
        else if($n>1000) return round(($n/1000),1).' K';
        else if($n < 1000) return $n;

    }

    

}

?>