<?php
    function lang($msg) {

        $lang = [
            'itemmaster' => 'アイテムマスター', 
            'itemindex' => 'アイテム インデックス',
            'itemcode' => 'アイテムコード', 
            'itemname' => '項目名',
            'searchstr' => '検索文字列',
            'speciafication' => '仕様',
            'typeofitem' => 'アイテムの種類',
            'clear' => 'クリア',
            'end' => '終了',
            'select' => '選択する',
            'view' => '意見',
            'back' => '戻る',
            'drawingno' => '図面番号',
            'saleenddate' => '販売終了日',
            'search' => '検索',
            'rowcount' => '行数',
            'detail' => '詳細',
            'title' => 'タイトル',
            'value' => '価値',
            'no' => 'NO',
        ];

        return !empty($lang[$msg]) ? $lang[$msg]: $msg;    
    }
?>
