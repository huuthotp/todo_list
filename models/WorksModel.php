<?php
require_once 'models/DBModel.php';
/**
 * WorksModel: model use processing data of table est_list_works
 * 
 * @author nguyenhuutho
 * @see getDataWorks: function get all data not deleted in table est_list_works
 * @see addWorks    : function add new record to table est_list_works
 * @see editWorks   : function edit/update data of record table est_list_works
 * @see deleteWorks : function delete (update column est_list_works.delete_flg = 1) of record table est_list_works
 */
class WorksModel extends DBModel {
	// Variable connected database
	var $conn;
	
	/**
	 * __construct: call function connect() of DBModel
	 */
	function __construct() {
		$this->conn = $this->connect();
	}

	/**
	 * getDataWorks: get list works not deleted
	 * 
	 * @author Nguyen Huu Tho
	 * @param string $id
	 * @return array data
	 */
	public function getDataWorks($id = null) {
		$sql = " SELECT id, work_name, starting_date, ending_date, status FROM est_list_works WHERE delete_flg = ? ";
		if ($id != null) {
			$sql .= " AND id = ? ";
			$stmt = $this->conn->prepare($sql);
			if (!$stmt) {
				error_log("Error Database" . PHP_EOL, 3, PATH_ERROR_LOG);
				return array();
			}
			$stmt->bind_param('ii', $flg = '0', $id);
		} else {
			$stmt = $this->conn->prepare($sql);
			if (!$stmt) {
				error_log("Error Database" . PHP_EOL, 3, PATH_ERROR_LOG);
				return array();
			}
			$stmt->bind_param('i', $flg = '0');
		}
		$stmt->execute();
		if (!empty($stmt->error)) {
			error_log($stmt->error . PHP_EOL, 3, PATH_ERROR_LOG);
			return array();
		}
		$result = $stmt->bind_result($id, $work_name, $starting_date, $ending_date, $status);		
		$listData = array();
		
		while ($stmt->fetch()) {
			$listData[] = array('id' => $id, 'work_name' => $work_name,
					'starting_date' => $starting_date,
					'ending_date' => $ending_date,
					'status' => $status);
		}
		return $listData;
	}

	/**
	 * addWorks: add new work
	 * 
	 * @author Nguyen Huu Tho
	 * @param string $workName
	 * @param string $startDate
	 * @param string $endDate
	 * @param string $status
	 * @return true: if insert success || fale: if error
	 */
	public function addWorks($workName, $startDate, $endDate, $status) {
		if (!isset($workName) || !isset($startDate) || !isset($endDate) || !isset($status)) {
			return false;
		}
		$sql = "INSERT INTO est_list_works (work_name, starting_date, ending_date, status, create_time, update_time) VALUES (?, ?, ?, ?, ?, ?)";
		$stmt = $this->conn->prepare($sql);
		if ($stmt) {
			$stmt->bind_param('ssssss', $workName, $startDate, $endDate, $status, date('Y-m-d', time()), date('Y-m-d', time()));
			$stmt->execute();
			if (!empty($stmt->error)) {
				error_log($stmt->error . PHP_EOL, 3, PATH_ERROR_LOG);
				return false;
			}
			$stmt->close();
			return true;
		} else {
			error_log(ERR_CONNECT_DB . PHP_EOL, 3, PATH_ERROR_LOG);
			header('Location: /error.html');
		}
	}

	/**
	 * editWorks: edit/update work
	 * 
	 * @author Nguyen Huu Tho
	 * @param string $workName
	 * @param string $startDate
	 * @param string $endDate
	 * @param string $status
	 * @param string $id
	 * @return true: if update success || fale: if error
	 */
	public function editWorks($workName, $startDate, $endDate, $status, $id) {
		if (!isset($workName) && !isset($startDate) && !isset($endDate) && !isset($status)) {
			return false;
		}
		$sql = "UPDATE est_list_works SET work_name = ?, starting_date = ?, ending_date = ?, status = ?, update_time = ?  WHERE id = ?   ";
		$stmt = $this->conn->prepare($sql);
		if ($stmt) {
			$stmt->bind_param('sssssi', $workName, $startDate, $endDate, $status, date('Y-m-d', time()), $id);
			$stmt->execute();
			if (!empty($stmt->error)) {
				error_log($stmt->error . PHP_EOL, 3, PATH_ERROR_LOG);
				return false;
			}
			$stmt->close();
			return true;
		} else {
			error_log(ERR_CONNECT_DB . PHP_EOL, 3, PATH_ERROR_LOG);
			header('Location: /error.html');
		}
	}

	/**
	 * deleteWorks: update column est_list_works.delete_flg = 1
	 * 
	 * @author Nguyen Huu Tho
	 * @param string $id
	 * @return true: if update success || fale: if error
	 */
	public function deleteWorks($id) {
		if (!isset($id)) {
			return false;
		}
		$sql = " UPDATE est_list_works SET delete_flg = ?, update_time = ? WHERE id = ? " ;
		$stmt = $this->conn->prepare($sql);
		$flg = '1';
		if ($stmt) {
			$stmt->bind_param('isi', $flg, date('Y-m-d h:i:s', time()), $id);
			$stmt->execute();
			if (!empty($stmt->error)) {
				error_log($stmt->error . PHP_EOL, 3, PATH_ERROR_LOG);
				return false;
			}
			$stmt->close();
			return true;
		} else {
			error_log(ERR_CONNECT_DB . PHP_EOL, 3, PATH_ERROR_LOG);
			header('Location: /error.html');
		}
	}
}
?>