<?php
    function lang($msg) {

	    $lang = [
	        'close' => '近い',
	        'yes' => 'はい',
	        'nono' => 'いいえ',
	        'question1' => 'このプロセスを終了しますか ?',
	        'validation1' => '赤い線で囲まれたすべての必須フィールドに入力する必要があります。',
	        'success' => 'アップデート成功！',

	       	'msg1' => '他のコンピューターで使用中のため、処理することができません。',
	    ];
		    
        return $lang[$msg];    
    }

?>