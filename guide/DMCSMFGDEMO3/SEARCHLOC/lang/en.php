<?php
    function lang($msg) {

        $lang = [
            'locationindex' => 'Location Index', 
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
            'loccode' => 'Location Code',
            'locname' => 'Location Name',
            'loctype' => 'Location Type',
        ];

        return !empty($lang[$msg]) ? $lang[$msg]: $msg;    
    }
?>