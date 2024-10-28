<?php
    function lang($msg) {
    	
	    $txtbylang = [
	        'login' => 'Login', 
	        'compcode' => 'Company Code', 
	        'comppwd' => 'Company Password', 
	        'userid' => 'User ID', 
	        'userpwd' => 'User Password', 
	        'serverurl' => 'Server URL', 
	        'btnlogin' => 'Login',
	        'language' => 'Language',

			'software1' => 'This software was developed by Cloud2Works (Thailand) Co.,Ltd.',
			'software2' => 'Its software house ID is XXXX and the software number of this software is X-XXXX.',
			'software3' => 'This software is standard software of The Revenue Department belonging to tax type ข‚.',
	    ];

        return $txtbylang[$msg];    
    }	    
?>
