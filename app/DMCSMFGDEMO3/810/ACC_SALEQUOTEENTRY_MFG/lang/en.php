<?php
    function lang($msg) {
        $lang = [

            'searchcondition' => 'Search Conditions',

            'groupquoteheader' => 'Quote Header Data',
            'groupcustomer' => 'Customer',
            'groupquotedetail' => 'Quote Details Data',
            'groupquoteitem' => 'Quote Items',
            'grouptotal' => 'Total',
            'groupitemremark' => 'Remark',
            'groupitementry' => 'Items Entry Form',
            
            'newitems' => 'New Item',
            'saveitems' => 'Save Item',
            'deleteitems' => 'Delete Item',

            'yes' => 'Yes',
            'no' => 'No',
            'ok' => 'Ok',
            'close' => 'Close',

            'canceled' => 'Canceled.',

            'question1' => 'Do you want to end this process ?',
            'question2' => 'Do you want to cancel the data ? (After cancellation processing, data cannot be reused.)',
            'question3' => 'Do you want to record the data ?',
            'question4' => 'Do you want to print this data ?',

            'validation1' => 'All the mandatory fields surrounded in red line need to be completed.',

        ];

        return !empty($lang[$msg]) ? $lang[$msg] : $msg;
    }
?>
