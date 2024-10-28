<?php

    function lang($msg) {

    $lang = [
            'close' => '近い',
            'clear' => 'クリア',
            'yes' => 'はい',
            'no' => 'いいえ',
            'ok' => 'Ok',
            'nono' => 'いいえ',
            'canceled' => 'キャンセル。',
            
            'question1' => 'このプロセスを終了しますか ?',
            'question2' => 'このデータを印刷しますか ?',

            'validation1' => '赤い線で囲まれたすべての必須フィールドに入力する必要があります。',

            'success' => 'システムへのエントリ。 総勘定元帳はもう。',
            
        ];

        return $lang[$msg];

    }
?>
