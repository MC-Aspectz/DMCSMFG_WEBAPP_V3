<?php

    function lang($msg) {
    	
	    $lang = [
	        'close' => 'Close',
	        'yes' => 'Yes',
	        'no' => 'No',

	        'question1' => 'Do you want to end this process ?',

	        'validation1' => 'All the mandatory fields surrounded in red line need to be completed.',
	        
	        'warning1' => 'This order has been completed or closed. It can not be modified or deleted.',
	        
	    ];

        return !empty($lang[$msg]) ? $lang[$msg]: '';
        
    }
?>
