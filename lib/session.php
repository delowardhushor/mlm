<?php

	class session{

		public static function init(){
			session_start();
		}

		public static function set($key, $value){
			 $_SESSION[$key] = $value;
		}

		public static function get($key){
			if (isset($_SESSION[$key])) {
				return $_SESSION[$key];
			}else{
				return false;
			}
		}

		public static function chk_session(){
			self::init();
			if (self::get("login") == false) {
				self::destroy();
				echo "<script>window.location ='login.php';</script>";
			}
		}

		public static function chk_login(){
			self::init();
			if (self::get("login") == true) {
				echo "<script>window.location ='index.php';</script>";
			}

		}

		public static function destroy(){
			session_destroy();
			echo "<script>window.location ='login.php';</script>";
		}	


	}





?>