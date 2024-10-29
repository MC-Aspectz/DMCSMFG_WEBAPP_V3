<?php
    function lang($msg) {

        $lang = [
            'ERRO_NOCURCD' => '通貨コードを入力してください。',
            'ERRO_NO_CUTOMER' => '顧客コードを入力してください。',
            'ERRO_SALEORDERNO' => '販売注文番号を入力してください。',
            'WARN_CANCALEDQUOTE' => 'WARN_CANCALEDQUOTE',

            'searchcondition' => '検索条件',

            'groupsaleheader' => '販売注文ヘッダーデータ',
            'groupcustomer' => '顧客',
            'grouprecipient' => '受取人',
            'groupsaledetail' => '販売注文詳細データ',
            'groupsaleitem' => '販売注文商品',
            'grouptotal' => '合計',
            'groupitemremark' => '述べる',
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
            'validation2' => '商品コードを入力してください。',
                        
        ];

        return !empty($lang[$msg]) ? $lang[$msg] : $msg;

    }
?>