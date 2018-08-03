<?php
/**
 * View List Works
 * @author Nguyen Huu Tho
 * @see showListWorks: set template and render data for action listWorks
 */
class ListWorks {
	/**
	 * showlistWorks
	 * 
	 * @author Nguyen Huu Tho
	 * @param array $listData
	 * @param array $err
	 */
	public function showlistWorks($listData, $err = array()) {
		require_once 'templates/html/listWorks.html';		
	}
}
?>