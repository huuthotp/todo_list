<?php
/**
 * AppController
 * 
 * @author Nguyen Huu Tho
 * @see initView($view, $action): return view and action of view
 * @see passDataView(): function set data of view
 *
 */
class AppController {
	var $passData = array();
	var $numArgs = 0;
	
	/**
	 * initView: initialization view and call function set template, set data to view 
	 * 
	 * @author Nguyen Huu Tho
	 * @param string $view
	 * @param string $action
	 */
	public function initView($view = 'ListWorks', $action = 'showWorks') {
		require_once 'views/' . $view . '.php';
		$clView = new $view();
		// call function set template and pass data of view
		$template = call_user_func_array(array($clView, $action), $this->passData);
	}
	
	/**
	 * passDataView: data will show in template
	 * 
	 * @author Nguyen Huu Tho
	 */
	public function passDataView() {
		// get list params of function
		$this->numArgs = func_num_args();
		$arg_list = func_get_args();
		for ($i = 0; $i < $this->numArgs; $i++) {
	        $this->passData[] = $arg_list[$i];
	    }
	}
}
?>