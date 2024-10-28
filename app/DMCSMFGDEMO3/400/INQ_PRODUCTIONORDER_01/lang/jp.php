<?php

    function lang($msg) {

	    $lang = [
	        'close' => 'Close',
	        'yes' => 'はい',
	        'no' => 'いいえ',
	        
	        'question1' => 'このプロセスを終了しますか ?',
	    ];

      	return !empty($lang[$msg]) ? $lang[$msg]: '';
        
    }
?>
