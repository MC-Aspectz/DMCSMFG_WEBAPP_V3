<?php

    function lang($msg) {

    $lang = [
        "close" => '近い',
        "clear" => "クリア",
            "yes" => "はい",
            "no" => "いいえ",
            "ok" => "Ok",
            "nono" => "いいえ",
            "canceled" => "キャンセル。",
            
            "question1" => "このプロセスを終了しますか ?",
            "question2" => "繰り返しパターンのデータを保存しますか ?",
        
            "success" => "システムへのエントリ。 総勘定元帳はもう。",
            
        ];

        return $lang[$msg];

    }
?>
