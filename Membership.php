<?php

class Membership {
	
	function validate_user($pwd) {
		
		
		if($pwd == "shivRatri") {
			$_SESSION['umpireMode'] = 'authorized';
			header("location: index.php");
		} //else return "Please enter a correct username and password";
		
	} 
	
	function log_User_Out() {
		if(isset($_SESSION['umpireMode'])) {
			unset($_SESSION['umpireMode']);
			
			if(isset($_COOKIE[session_name()])) 
				setcookie(session_name(), '', time() - 1000);
				session_destroy();
		}
	}
	
	function confirm_Member() {
		session_start();
		if($_SESSION['umpireMode'] !='authorized') header("location: index.php");
	}
	
}