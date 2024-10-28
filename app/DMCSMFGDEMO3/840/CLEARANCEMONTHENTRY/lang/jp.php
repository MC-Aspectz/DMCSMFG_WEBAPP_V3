<?php
    function lang($msg) {

        $lang = [
            'close' => '近い',
            'yes' => 'はい',
            'no' => 'いいえ',

            'question1' => 'このプロセスを終了しますか ?',
            
            'validation1' => '赤い線で囲まれたすべての必須フィールドに入力する必要があります。',

            'ERRORUNCHECK' => '他のコンピューターで使用中のため、処理することができません。',

            'ERRO_CLEARANCE_DATE' => 'ERRO_CLEARANCE_DATE',
        ];
            
        return $lang[$msg];    
    }

?>