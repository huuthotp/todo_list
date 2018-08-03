<?php
// load define
require_once 'configs/Config.php';

/**
 * DbModel: Model use connected database
 * 
 * @author nguyenhuutho
 * @see connect(): function connect database. If error: redirect error.html
 */
class DbModel {
	
	/**
	 * connect database
	 * 
	 * @author Nguyen Huu Tho
	 */
	public function connect() {
		// Create connection
		$conn = new mysqli(HOST, USER_DB, PASSWORD, DATABASE);
		// Check connection
		if ($conn->connect_error) {
			error_log(ERR_CONNECT_DB, 3, "log/error.log");
			header('Location: /error.html');
		}
		return $conn;
	}
}
?>