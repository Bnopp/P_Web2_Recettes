<?php
/**
* Class and Function List:
* Function list:
* - display()
* Classes list:
* - Controller
*/

/**
 * ETML
 * @author   : Serghei Diulgherov
 * Date     : 04.04.2022
 * Main controller
 */

class Controller {

	/**
	 * Method allowing to call for an action
	 *
	 * @return void
	 */
	public function display() {
		$page = $_GET['action'] . "Display";

		$this->$page();
	}
}
?>
