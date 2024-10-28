<?php

    function lang($msg) {
        
        $lang = [
            "itemmaster" => "アイテムマスター", 
            "searchstr" => "検索文字列",
            "suppliercd" => "サプライヤーコード",
            "clear" => "クリア",
            "end" => "終了",
            "select" => "選択する",
            "view" => "意見",
            "back" => "戻る",
            "search" => "検索",
            "rowcount" => "行数",
            "detail" => "詳細",
            "title" => "タイトル",
            "value" => "価値",
            "supplierindex" => "サプライヤー インデックス",
            "suppliername" => "サプライヤ名",
            "address" => "住所",
            "close" => "Close", 

        ];

        return !empty($lang[$msg]) ? $lang[$msg]: $msg;    
    }
?>