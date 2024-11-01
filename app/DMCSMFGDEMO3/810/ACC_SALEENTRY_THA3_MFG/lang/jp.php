<?php
    function lang($msg) {

        $lang = [
            'ERRO_NOCURCD' => 'ERRO_NOCURCD',
            'ERRO_NO_CUTOMER' => 'ERRO_NO_CUTOMER',
            'ERRO_SALEORDERNO' => 'ERRO_SALEORDERNO',
            'WARN_CANCALEDQUOTE' => 'WARN_CANCALEDQUOTE',

            'searchcondition' => '検索条件',

            'groupheader' => '請求書/販売伝票ヘッダーデータ',
            'groupcustomer' => '顧客',
            'groupdetail' => '請求書/販売伝票詳細データ',
            'groupitem' => '請求書/販売券項目',
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
            'validation2' => '転載理由を入力の上、発行ボタンを押してください。',

            'erro1' => 'ご注文よりも在庫が少なくなっています。在庫を再確認し、数量を調整してください。',
            'erro2' => '継続記録法で扱う品目の論理在庫が不足しています。処理できません。',
            'erro3' => '品目情報が入力されていません。',
            
            'success' => 'システムへのエントリ。 総勘定元帳はもう。',
        ];

        return !empty($lang[$msg]) ? $lang[$msg] : $msg;
    }
?>
