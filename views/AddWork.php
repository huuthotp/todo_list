<?php
/**
 * View Add Work
 * 
 * @author Nguyen Huu THo
 * @see createWork: function set template html for action addWork
 */
class AddWork {
	
	/**
	 * createWork: set template and pass data to html
	 * @param array $status
	 * @param array $err
	 */
	function createWork($status, $err = array()) {
		require_once 'templates/html/addWork.html';
	}
}

?>