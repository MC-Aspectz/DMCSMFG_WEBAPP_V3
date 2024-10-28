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
            'validation2' => 'アイテム情報がありません。',
            'validation3' => 'この仕入先請求書番号は以前に使用されていました。',
            'validation4' => 'システムへのエントリ。 総勘定元帳はもう。',
            'validation5' => '印刷するものがありません。',
            'validation6' => 'サプライヤー請求書の日付が受け入れられません。',
        ];
        
    return !empty($lang[$msg]) ? $lang[$msg]: $msg;    
}       
?>

