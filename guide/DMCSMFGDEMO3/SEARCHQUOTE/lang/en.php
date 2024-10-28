<?php
    function lang($msg) {
        
        $lang = [
            'quoteentry' => 'Quote Entry',
            'quotationindex' => 'Quotation Index', 
            'CUSTOMERCODE' => 'Customer Code', 
            'CUSTOMERNAME' => 'Customer Name',
            'ESTIMATE_NO' => 'Quote No.',
            'ESTTMNAME' => 'Product Name',
            'HEADER_DATE' => 'Date',
            'DELI_PLACE' => 'Recipient',
            'DELE_PLACE_NAME' => 'Recipient Name',
            'SEARCH' => 'Search',        
            'select' => 'Select',
            'view' => 'View',
            'clear' => 'Clear',
            'back' => 'Back',
            'end' => 'End',
            'no' => 'NO',
            'rowcount' => 'Row Count',
            'detail' => 'Detail',
            'title' => 'Title',
            'value' => 'Value',
        ];

        return !empty($lang[$msg]) ? $lang[$msg]: $msg;    
    }
?>
