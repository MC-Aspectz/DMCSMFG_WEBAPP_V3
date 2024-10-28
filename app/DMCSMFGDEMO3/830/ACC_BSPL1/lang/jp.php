<?php

    function lang($msg) {

        $lang = [
            "clear" => "クリア",
            "clear" => "クリア",
            "yes" => "はい",
            "no" => "いいえ",
            "ok" => "Ok",
            "nono" => "いいえ",
    
            "question1" => "このプロセスを終了しますか ?",
            "question2" => "このデータを印刷しますか ?",
            
            "validation1" => "赤い線で囲まれたすべての必須フィールドに入力する必要があります。",
            "validation2" => "印刷するものがありません。",
            
        ];

        return $lang[$msg];

    }
?>
