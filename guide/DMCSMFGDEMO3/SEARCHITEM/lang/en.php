<?php

    function lang($msg) {

        $lang = [
            'itemmaster' => 'Item Master',
            'itemindex' => 'Item Index', 
            'itemcode' => 'Item Code', 
            'itemname' => 'Item Name',
            'searchstr' => 'Search String',
            'speciafication' => 'Specification',
            'typeofitem' => 'Type of Item',
            'drawingno' => 'Drawing No.',
            'saleenddate' => 'Sales End Date',
            'search' => 'Search',
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
