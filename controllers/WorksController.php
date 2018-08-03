<?php
require_once 'controllers/AppController.php';
require_once 'models/WorksModel.php';
require_once 'models/StatusModel.php';

/**
 * Controll processing actions of WORKS
 *
 * @author Nguyen Huu Tho
 * @see showWorks: action default, show all works was added
 * @see addWork: action add work
 * @see editWork: action use view detail works or edit work is watching or delete work
 */
class WorksController extends AppController {
	// content default of message error
	var $err = array('work_name' => null,
			'start_date' => null,
			'end_date' => null,
			'status' => null,
			'id' => null,
			'success' => null
	);

	/**
	 * show works not delete
	 *
	 * @author Nguyen Huu Tho
	 */
	public function showWorks() {
		// get data from database
		$worksModel = new WorksModel();
		$result = $worksModel->getDataWorks();
		// render data to view
		$this->passDataView($result, $this->err);
		// set view
		$this->initView('ListWorks', 'showlistWorks');
		return null;
	}

	/**
	 * insert new work to database
	 *
	 * @author Nguyen Huu Tho
	 */
	public function addWork() {
		// get data config of [STATUS]
		// value of status is value in table, can not change value from form input
		$statusModel = new StatusModel();
		$listStatus = $statusModel->getListStatus();

		// check value command
		$command = !isset($_POST['command']) ? null : $_POST['command'];
		if ($command == null) {
			// render data to view
			$this->passDataView($listStatus);
			// set view
			$this->initView('AddWork', 'createWork');
			return null;
		}
		// get date from form input
		$workName = $_POST['work_name'];
		$startDate = $_POST['start_date'];
		$endDate = $_POST['end_date'];
		$status = $_POST['status'];

		// validate data from form input
		$isError = $this->validate($workName, $startDate, $endDate, $status);
		if ($isError) {
			// render data to view
			$this->passDataView($listStatus, $this->err);
			// set view
			$this->initView('AddWork', 'createWork');
			return null;
		} else {
			// insert data to database
			$worksModel = new WorksModel();
			$result = $worksModel->addWorks($workName, $startDate, $endDate, $status);
			// get data
			$worksModel = new WorksModel();
			$result = $worksModel->getDataWorks();
			$this->err['success'] = "INSERT SUCCESS";
			// render data to view
			$this->passDataView($result, $this->err);
			// set view
			$this->initView('ListWorks', 'showlistWorks');
			return null;
		}
	}

	/**
	 * edit work, delete work, view detail work
	 *
	 * @author Nguyen Huu Tho
	 */
	public function editWork() {
		$command = !isset($_POST['command']) ? null : $_POST['command'];
		switch ($command) {
			case 'edit':
				$result = $this->_editWork();
				if ($result) {
					$id = $_POST['id'];
					// get data
					$worksModel = new WorksModel();
					$result = $worksModel->getDataWorks($id);

					$statusModel = new StatusModel();
					$listStatus = $statusModel->getListStatus();
					// render data to view
					$this->passDataView($result[0], $listStatus, $this->err);
					// set view
					$this->initView('ViewWork', 'viewDetailWork');
				}
				break;
			case 'delete':
				$result = $this->_deleteWork();
				$this->showWorks();
				break;
			default:
				$result = $this->_viewWork();
				break;
		}
		return null;
	}

	/**
	 * edit work
	 *
	 * @author Nguyen Huu Tho
	 */
	private function _editWork() {
		$id = $_POST['id'];
		if (empty($id)) {
			$this->err['id'] = "WORK ID NOT EXIST";
			return false;
		}
		// get data from form input
		$workName = $_POST['work_name'];
		$startDate = $_POST['start_date'];
		$endDate = $_POST['end_date'];
		$status = $_POST['status'];
		// validate data from form input
		$isError = $this->validate($workName, $startDate, $endDate, $status);
		if ($isError) {
			return false;
		}
		// insert data to database
		$worksModel = new WorksModel();
		$result = $worksModel->editWorks($workName, $startDate, $endDate, $status, $id);
		if (!$result) {
			$this->err['database'] = 'ERROR DATABASE';
			return false;
		}
		$this->err['success'] = 'UPDATE SUCCESS';
		return true;
	}

	/**
	 * delete work
	 *
	 * @author Nguyen Huu Tho
	 * @return boolean
	 */
	private function _deleteWork() {
		$id = $_POST['id'];
		if (empty($id)) {
			$this->err['id'] = "WORK ID NOT EXIST";
			return false;
		}
		// insert data to database
		$worksModel = new WorksModel();
		$result = $worksModel->deleteWorks($id);
		if (!$result) {
			$this->err['database'] = 'ERROR DATABASE';
			return false;
		}
		$this->err['success'] = 'DELETE SUCCESS';
		return $result;
	}

	/**
	 * view work
	 *
	 * @author Nguyen Huu Tho
	 */
	private function _viewWork() {
		$id = !isset($_GET['id']) ? null : $_GET['id'];
		if ($id == null) {
			$this->err['id'] = "WORK ID NOT EXIST";
			$this->showWorks();
			return false;
		}
		// get data
		$worksModel = new WorksModel();
		$result = $worksModel->getDataWorks($id);
		
		$statusModel = new StatusModel();
		$listStatus = $statusModel->getListStatus();
		// render data to view
		$this->passDataView($result[0], $listStatus, $this->err);
		// set view
		$this->initView('ViewWork', 'viewDetailWork');
		return true;
	}
	
	/**
	 * validate data input from form
	 * 
	 * @author Nguyen Huu Tho
	 * @param string $workName
	 * @param string $startDate
	 * @param string $endDate
	 * @param string $status
	 */
	private function validate($workName, $startDate, $endDate, $status) {
		$isError = false;
		// this values is required
		if (empty($workName)) {
			$this->err['work_name'] = "PLEASE INPUT WORK NAME";
			$isError = true;
		}
		if (empty($startDate)) {
			$this->err['start_date'] = "PLEASE INPUT STARTING DATE";
			$isError = true;
		}
		if (empty($endDate)) {
			$this->err['end_date'] = "PLEASE INPUT ENDING DATE";
			$isError = true;
		}
		if (empty($status)) {
			$this->err['status'] = "PLEASE INPUT STATUS";
			$isError = true;
		}
		// validate date of starting_date and ending_date
		//check format
		if (!empty($startDate)) {
			$aryStartDate = explode("-", $startDate);
			if (!checkdate($aryStartDate[1], $aryStartDate[2], $aryStartDate[0])) {
				$this->err['start_date'] = "ERROR FORMAT DATE";
				return true;
			}
		}
		if (!empty($endDate)) {
			$aryEndDate = explode("-", $endDate);
			if( !checkdate($aryEndDate[1], $aryEndDate[2], $aryEndDate[0])) {
				$this->err['end_date'] = "ERROR FORMAT DATE";
				return true;
			}
		}
		// check start date bigger end date
		$sTime = strtotime($startDate);
		$eTime = strtotime($endDate);
		if ($sTime > $eTime) {
			$this->err['end_date'] = "Starting Date Less Ending Date";
			return true;
		}
		
		$statusModel = new StatusModel();
		$listStatus = $statusModel->getListStatus();
		if (!empty($status) && $listStatus[$status] == null){ // validate value of status
			$this->err['status'] = "STATUS NOT EXIST";
			$isError = true;
		}
		return $isError;
	}
}
?>