<?php

    function lang($msg) {

	    $lang = [
	        'close' => 'ปิด',
	        'yes' => 'ใช่',
	        'no' => 'ไม่',
	        
	        'question1' => 'คุณต้องการสิ้นสุดกระบวนการนี้หรือไม่ ?',
	    ];

        return !empty($lang[$msg]) ? $lang[$msg]: '';
        
    }
?>
