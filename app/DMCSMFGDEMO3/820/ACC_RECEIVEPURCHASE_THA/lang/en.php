<?php
    function lang($msg) {

	    $lang = [
			'close' => 'Close',
			'yes' => 'Yes',
			'no' => 'No',
			'question1' => 'Do you want to end this process ?',
			'question2' => 'Do you want to print this data ?',
	        'question3' => 'Do you want to record the data ?',
	        'question4' => 'Do you want to cancel the data ? (After cancellation processing, data cannot be reused.)',

			'validation1' => 'All the mandatory fields surrounded in red line need to be completed.',
	      	'validation2' => 'Item information is missing.',
			'validation3' => 'This supplier invoice number was used before.',
	        'validation4' => 'Entry into the system. General ledger already.',
	        'validation5' => 'Nothing to Print.',
	        'validation6' => 'The Supplier Invoice date is not accept.',
	    ];

      	return !empty($lang[$msg]) ? $lang[$msg]: $msg;    
    }
?>
