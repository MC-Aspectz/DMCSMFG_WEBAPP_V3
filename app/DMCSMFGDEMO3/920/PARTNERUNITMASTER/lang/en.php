<?php
    function lang($msg) {

        $lang = [

            'close' => 'Close',
            'yes' => 'Yes',
            'no' => 'No',
            'csv' => 'CSV',

            'detail' => 'Detail',

            'question1' => 'Do you want to end this process ?',
            'question2' => 'Do you want to print this data ?',

            'validation1' => 'All the mandatory fields surrounded in red line need to be completed.',
        ];
        
        return !empty($lang[$msg]) ? $lang[$msg] : $msg;
        
    }
?>
