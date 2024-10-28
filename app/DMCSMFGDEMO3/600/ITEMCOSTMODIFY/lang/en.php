<?php
    function lang($msg) {

	    $lang = [
	        'close' => 'Close', 
	        'yes' => 'Yes',
	        'no' => 'No',

	        'question1' => 'Do you want to end this process ?',

	        'validation1' => 'All the mandatory fields surrounded in red line need to be completed.',
 			'validation2' => 'Item code is not existing. please enter correct item code.',

	    ];
		    
        return $lang[$msg];    
    }

?>