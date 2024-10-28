<?php
    function lang($msg) {

	    $lang = [
	        'close' => '近い',
	        'yes' => 'はい',
	        'no' => 'いいえ',

	        'question1' => 'このプロセスを終了しますか ?',
	        
	        'validation1' => '赤い線で囲まれたすべての必須フィールドに入力する必要があります。',
 			'validation2' => 'アイテムコードが存在しません。正しいアイテムコードを入力してください',

	    ];
		    
        return $lang[$msg];    
    }

?>