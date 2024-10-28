<?php

    function lang($msg) {
    	
	    $lang = [
	    	'close' => 'Close',
	        'yes' => 'はい',
	        'no' => 'いいえ',
	        
			'question1' => 'このプロセスを終了しますか ?',
	      	'question2' => '配送数量が予約残高を超えています。続行しますか ?',

	        'validation1' => '赤い線で囲まれたすべての必須フィールドに入力する必要があります。',

	        'warning1' => 'この注文は完了または終了しました。 変更または削除することはできません。',
	    ];

        return !empty($lang[$msg]) ? $lang[$msg]: '';
        
    }
?>
