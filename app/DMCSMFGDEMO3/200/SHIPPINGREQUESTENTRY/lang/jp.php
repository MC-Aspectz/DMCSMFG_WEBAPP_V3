<?php
    function lang($msg) {

        $lang = [
            'close' => '近い',
            'yes' => 'はい',
            'no' => 'いいえ',

            'question1' => 'このプロセスを終了しますか ?',
            
            'validation1' => '赤い線で囲まれたすべての必須フィールドに入力する必要があります。',
            'validation2' => '入力された値は要求された出荷残高より大きいです。続行しますか?',

        ];
            
        return $lang[$msg];    
    }

?>