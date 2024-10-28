<?php

    function lang($msg) {

        $lang = [
            "itemmaster" => "Item Master",
            "searchstr" => "Search String",
            "suppliercd" => "Supplier Code",
            "clear" => "Clear",
            "end" => "End",
            "select" => "Select",
            "view" => "View",
            "back" => "Back",
            "search" => "Search",
            "rowcount" => "Row Count",
            "detail" => "Detail",
            "title" => "Title",
            "value" => "Value",
            "supplierindex" => "Supplier Index",
            "suppliername" => "Supplier Name",
            "address" => "Address",
            "close" => "Close",

        ];
        
        return !empty($lang[$msg]) ? $lang[$msg]: $msg;    
    }
?>
