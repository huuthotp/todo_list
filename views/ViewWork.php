<?php
/**
 * View View Work
 * 
 * @author Nguyen Huu THo
 * @see viewDetailWork: set template and render data for action ViewWork
 */
class ViewWork {
	/**
	 * viewDetailWork
	 * 
	 * @author Nguyen Huu THo
	 * @param array $work
	 * @param array $status
	 * @param array $err
	 */
	function viewDetailWork($work, $status = array(), $err = array()) {
		require_once 'templates/html/viewWork.html';
	}
}

?>