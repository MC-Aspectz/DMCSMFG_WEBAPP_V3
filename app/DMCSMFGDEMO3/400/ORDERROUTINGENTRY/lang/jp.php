<?php
    function lang($msg) {

	    $lang = [

	   		'close' => 'Close',
	        'yes' => 'はい',
	        'no' => 'いいえ',

	     	'question1' => 'このプロセスを終了しますか ?',

	       	'validation1' => '赤い線で囲まれたすべての必須フィールドに入力する必要があります。',
	    ];
    
        return !empty($lang[$msg]) ? $lang[$msg] : $msg;
        
    }
?>