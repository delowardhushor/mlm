<?php
Class Database{
	public $host   = DB_HOST;
	public $user   = DB_USER;
	public $pass   = DB_PASS;
	public $dbname = DB_NAME;
	
	
	public $link;
	public $error;
	
	public function __construct(){
		$this->connectDB();
	}
	
	private function connectDB(){
	$this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
	if(!$this->link){
		$this->error ="Connection fail".$this->link->connect_error;
		return false;
	}
 }
	
	// Select or Read data
	
	public function select($query){
		$result = $this->link->query($query) or die($this->link->error.__LINE__);
		if($result->num_rows > 0){
			return $result;
		} else {
			return false;
		}
	}
	
	// Insert data
	public function insert($query){
	$insert_row = $this->link->query($query) or die($this->link->error.__LINE__);
	if($insert_row){
		return $insert_row;
	} else {
		return false;
	}
  }
  
    // Update data
  	public function update($query){
	$update_row = $this->link->query($query) or die($this->link->error.__LINE__);
	if($update_row){
		return $update_row;
	} else {
		return false;
	}
  }
  
  // Delete data
   public function delete($query){
	$delete_row = $this->link->query($query) or die($this->link->error.__LINE__);
	if($delete_row){
		return $delete_row;
	} else {
		return false;
	}
  }

  public function chk_exist_catagory($name){
		$query = "select * from order_catagory where catagory_name = '$name'";
		$result= $this->link->query($query);
		if($result->num_rows > 0){
			return true;
		} else {
			return false;
		}
	}

	public function chk_exist_income_catagory($name){
		$query = "select * from income_catagory where income_name = '$name'";
		$result= $this->link->query($query);
		if($result->num_rows > 0){
			return true;
		} else {
			return false;
		}
	}

	public function chk_exist_expense_catagory($name){
		$query = "select * from expense_catagory where expense_name = '$name'";
		$result= $this->link->query($query);
		if($result->num_rows > 0){
			return true;
		} else {
			return false;
		}
	}

	


	public function chk_exist_email($email){
		$query = "select * from tbl_user where email= '$email'";
		$result= $this->link->query($query);
		if($result->num_rows > 0){
			return true;
		} else {
			return false;
		}
	}	

 
 
}

