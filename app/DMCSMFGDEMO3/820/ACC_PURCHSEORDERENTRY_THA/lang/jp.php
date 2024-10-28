<?php
    function lang($msg) {

        $lang = [
            'close' => '近い',
            'yes' => 'はい',
            'no' => 'いいえ',
            'question1' => 'このプロセスを終了しますか ?',
            'question2' => 'このデータを印刷しますか ?',
    		'question3' => 'データを記録しますか ?',
    		'question4' => 'データをキャンセルしますか ？ （解約処理後のデータの再利用はできません。）',
          

            'validation1' => '赤い線で囲まれたすべての必須フィールドに入力する必要があります。',
            'validation2' => 'サプライヤーコードを入力してください。',
        ];
        
        return !empty($lang[$msg]) ? $lang[$msg] : $msg;
    }
?>
