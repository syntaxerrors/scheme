<?php

class HomeController extends Core_HomeController {

    public function getIndex()
    {

    }

    public function getTest() {
    	/**
    	 * Include test file then die.
    	 * this should only be accessable when debug is enabled.
    	 */

    	if ( Config::get('app.debug') == true) {
    		include(app_path() . '/test.php');
    	} else {
    		die('Debug mode must be enabled.');
    	}

    	die;
    }
}