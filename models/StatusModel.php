<?php
require_once 'models/DBModel.php';

/**
 * StatusModel: model use processing data of table est_status
 * 
 * @author Nguyen Huu Tho
 * @see getListStatus: get all list status
 */
class StatusModel extends DBModel {
	// Variable connected database
	var $conn;
	
	/**
	 * __construct: call function connect() of DBModel
	 */
	function __construct() {
		$this->conn = $this->connect();
	}
	
	/**
	 * getListStatus: get all list status in table est_status
	 * 
	 * @author Nguyen Huu Tho
	 * @return array data
	 */
	public function getListStatus() {
		$sql = " SELECT * FROM est_status ";
		$result = $this->conn->query($sql);
		if (!$result) {
			error_log($this->conn->error . PHP_EOL, 0, PATH_ERROR_LOG);
			header('Location: /error.html');
		}
		$listData = array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$listData[$row['id']] = $row['status'];
			}
		}
		return $listData;
	}
}
?>