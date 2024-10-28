<?php
    function lang($msg) {

        $lang = [
            'itemmaster' => 'アイテムマスター', 
            'itemindex' => 'アイテム インデックス',

            'searchcondition' => '検索条件',
       
            'groupitem' => '検索、仕様、材質',
            'grouptype' => 'BOI、タイプ、カテゴリー',
            'groupunit' => '単位、包装、容量、重量',
            'grouppurchase' => '購入',
            'groupsale' => '販売',
            'groupinventory' => '在庫',
            'groupimage' => '商品画像',
            'groupworkcenter' => '作業センター、コストオプション',
            'gruopcheckbox' => 'FIFO リスト、在庫管理なし、製造計画、シリアル番号管理',
            
            'yes' => 'はい',
            'no' => 'いいえ',
            'close' => '近い', 

            'question1' => 'このプロセスを終了しますか ?',
            'validation1' => '赤い線で囲まれたすべての必須フィールドに入力する必要があります。',
        ];

        return !empty($lang[$msg]) ? $lang[$msg] : $msg;
    }
?>
