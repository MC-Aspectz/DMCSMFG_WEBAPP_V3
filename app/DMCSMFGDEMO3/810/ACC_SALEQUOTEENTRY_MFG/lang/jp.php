<?php
    function lang($msg) {
        $lang = [

            'searchcondition' => '検索条件',

            'groupheader' => 'キュー ヘッダー データ',
            'groupcustomer' => '顧客',
            'groupdetail' => 'キュー詳細データ',
            'groupitem' => 'キュー アイテム',
            'grouptotal' => '合計',
            'groupitemremark' => '述べる'
            'groupitementry' => '商品入力フォーム',

            'newitems' => '新規アイテム',
            'saveitems' => 'アイテムの保存',
            'deleteitems' => 'アイテムの削除',
            
            'yes' => 'はい',
            'no' => 'いいえ',
            'ok' => 'Ok',
            'close' => '近い', 

            'canceled' => 'キャンセル。',

            'question1' => 'このプロセスを終了しますか ?',
            'question2' => 'データをキャンセルしますか ？ （解約処理後のデータの再利用はできません。）',
            'question3' => 'データを記録しますか ?',
            'question4' => 'このデータを印刷しますか ?',
            
            'validation1' => '赤い線で囲まれたすべての必須フィールドに入力する必要があります。',
        ];
        
        return !empty($lang[$msg]) ? $lang[$msg] : $msg;
    }
?>
