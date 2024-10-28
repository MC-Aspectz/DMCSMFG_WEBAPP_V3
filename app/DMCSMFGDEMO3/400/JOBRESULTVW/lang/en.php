<?php

    function lang($msg) {
    	
	    $lang = [
	        'close' => 'Close',
	        'yes' => 'Yes',
	        'no' => 'No',

	        'question1' => 'Do you want to end this process ?',
	    ];

        return !empty($lang[$msg]) ? $lang[$msg]: '';
        
    }
?>
