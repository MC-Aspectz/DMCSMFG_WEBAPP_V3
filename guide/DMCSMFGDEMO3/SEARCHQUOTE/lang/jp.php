<?php
    function lang($msg) {
        
        $lang = [
            'quoteentry' => '見積もり入力',
            'quotationindex' => '引用インデックス', 
            'CUSTOMERCODE' => '顧客コード', 
            'customername' => '顧客名',
            'ESTIMATE_NO' => '見積もり番号',
            'ESTTMNAME' => '商品名',
            'HEADER_DATE' => '日にち',
            'DELI_PLACE' => '受信者',
            'DELE_PLACE_NAME' => '受信者の名前',
            'SEARCH' => '検索',
            'select' => '選択する',
            'view' => '意見',
            'back' => '戻る',
            'clear' => 'クリア',
            'end' => '終了',
            'no' => 'NO',
            'rowcount' => '行数',
            'detail' => '詳細',
            'title' => 'タイトル',
            'value' => '価値',
        ];

        return !empty($lang[$msg]) ? $lang[$msg]: $msg;    
    }
?>
