<?php

class HomeController extends Core_HomeController {

	// Method not needed if not doing anything YOUR WRONG! -- this is true
    public function getIndex()
    {
        echo "<br /><br /><br /><br />";
        pp(Session::all());
    }

    public function getTest()
    {
    	/**
    	 * Include test file then die.
    	 * this should only be accessable when debug is enabled.
    	 */

	  	if ( Config::get('app.debug') == true) {
	  		include(app_path('/test.php'));
	  	} else {
	  		throw new Exception('Debug mode must be enabled.');
	    }

		// Die to stop the layout from being rendered.
    	die;
    }
}