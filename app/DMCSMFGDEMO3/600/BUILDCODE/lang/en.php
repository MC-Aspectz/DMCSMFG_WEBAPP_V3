<?php
    function lang($msg) {

	    $lang = [
	        'close' => 'Close', 
	        'yes' => 'Yes',
	        'nono' => 'No',

	        'question1' => 'Do you want to end this process ?',

	        'validation1' => 'All the mandatory fields surrounded in red line need to be completed.',

	        'success' => 'Update Success !',

	       	'msg1' => 'The process is currently used by another computer.',
	    ];
		    
        return $lang[$msg];    
    }

?>