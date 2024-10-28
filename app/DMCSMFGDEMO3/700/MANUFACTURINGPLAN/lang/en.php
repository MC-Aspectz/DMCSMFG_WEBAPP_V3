<?php

    function lang($msg) {

	    $lang = [
	        'close' => 'Close',
	        'yes' => 'Yes',
	        'no' => 'No',

	        'validation1' => 'All the mandatory fields surrounded in red line need to be completed.',

	        'question1' => 'Do you want to end this process ?',

	        'ERRORUNCHECK' => 'The process is currently used by another computer.',
	    ];
	     
        return !empty($lang[$msg]) ? $lang[$msg]: '';
        
    }
?>
