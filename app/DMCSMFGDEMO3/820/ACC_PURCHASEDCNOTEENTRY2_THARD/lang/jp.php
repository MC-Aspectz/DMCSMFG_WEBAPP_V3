<?php
    function lang($msg) {

        $lang = [
            'clear' => 'クリア',
            'clear' => 'クリア',
            'ERRO_NOCURCD' => 'ERRO_NOCURCD',
            'ERRO_NO_CUTOMER' => 'ERRO_NO_CUTOMER',
            'ERRO_SALEORDERNO' => 'ERRO_SALEORDERNO',
            'WARN_CANCALEDQUOTE' => 'WARN_CANCALEDQUOTE',
            'yes' => 'はい',
            'no' => 'いいえ',
            'ok' => 'Ok',
            'nono' => 'いいえ',
            'canceled' => 'キャンセル。',
            'setofdocuments' => 'Documents are issued as a set',
            'question1' => 'このプロセスを終了しますか ?',
            'question2' => 'データをキャンセルしますか ？ （解約処理後のデータの再利用はできません。）',
            'question3' => 'データを記録しますか ?',
            'question4' => 'このデータを印刷しますか ?',
            'validation1' => '赤い線で囲まれたすべての必須フィールドに入力する必要があります。',
            'validation2' => '転載理由を入力の上、発行ボタンを押してください。',

            'erro1' => 'ご注文よりも在庫が少なくなっています。在庫を再確認し、数量を調整してください。',
            'erro2' => '継続記録法で扱う品目の論理在庫が不足しています。処理できません。',
            'erro3' => '品目情報が入力されていません。',
            
            'success' => 'システムへのエントリ。 総勘定元帳はもう。',
        ];

        return !empty($lang[$msg]) ? $lang[$msg] : $msg;
    }
?>
