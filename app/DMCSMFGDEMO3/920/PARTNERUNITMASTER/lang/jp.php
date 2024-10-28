<?php
    function lang($msg) {

        $lang = [

       		'close' => 'Close',
            'yes' => 'はい',
            'no' => 'いいえ',
            'csv' => 'CSV',

            'detail' => '詳細',

         	'question1' => 'このプロセスを終了しますか ?',
            'question2' => 'この情報を印刷しますか ?',

           	'validation1' => '赤い線で囲まれたすべての必須フィールドに入力する必要があります。',
        ];

        return !empty($lang[$msg]) ? $lang[$msg] : $msg;
    }
?>