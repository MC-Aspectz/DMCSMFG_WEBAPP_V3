<?php

    function lang($msg) {

        $lang = [
            'clear' => 'クリア',
            'clear' => 'クリア',
            'yes' => 'はい',
            'no' => 'いいえ',
            'ok' => 'Ok',
            'nono' => 'いいえ',
            'canceled' => 'キャンセル。',
            'setofdocuments' => 'Documents are issued as a set',
            'paidby' => '支払った',
            
            'question1' => 'このプロセスを終了しますか ?',
            'question2' => 'データをキャンセルしますか ？ （解約処理後のデータの再利用はできません。）',
            'question3' => 'データを記録しますか ?',
            'question4' => 'このデータを印刷しますか ?',
            'question5' => '繰り返しパターンのデータを保存しますか ?',
            'question6' => '説明データを保存しますか ?',
            
            'validation1' => '赤い線で囲まれたすべての必須フィールドに入力する必要があります。',
            'validation2' => '転載理由を入力の上、発行ボタンを押してください。',
            'validation3' => '印刷するものがありません。',
            'validation4' => 'サプライヤーコード。',

            'erro1' => 'ご注文よりも在庫が少なくなっています。在庫を再確認し、数量を調整してください。',
            'erro2' => '継続記録法で扱う品目の論理在庫が不足しています。処理できません。',
            'erro3' => '品目情報が入力されていません。',
            
            'success' => 'システムへのエントリ。 総勘定元帳はもう。',

            'ERRO:ERRO_NOTEXISTACC' => 'この科目コードは登録されていません',
            'ERRO:ERRO_NO_PAIDDETAILS' => '有料の詳細はありません',
            'ERRO:ERRO_NOT_EQUAL_DEBIT_AND_CREDIT' => '借方と貸方は等しくありません',
            'ERRO:ERRO_AMOUNT_EQUAL_ZERO' => '金額はゼロに等しい',
            'ERRO:ERRO_EXISTS_ROW_NOT_SETTING_ACCOUNT' => 'アカウントを設定していない行が存在します',
            'ERRO:ERRO_EXISTS_ROW_AMOUNT_ZERO' => '行数ゼロが存在します',
            'ERRO:ERRO_NOREMARK' => '説明を入力してください',
            
        ];

        return $lang[$msg];

    }
?>
