<?php

    function lang($msg) {

    $lang = [
        "close" => '近い',
        "clear" => "クリア",
            "yes" => "はい",
            "no" => "いいえ",
            "ok" => "Ok",
            "nono" => "いいえ",
    
            "question1" => "このプロセスを終了しますか ?",
            "question2" =>  "データを記録しますか ?",
            
            "validation1" => "赤い線で囲まれたすべての必須フィールドに入力する必要があります。",
            "validation2" => "印刷するものがありません。",

            'complete' => '完了',
            
        ];

        return $lang[$msg];

    }
?>
