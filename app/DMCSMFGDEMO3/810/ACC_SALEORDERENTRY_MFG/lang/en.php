<?php
    function lang($msg) {

        $lang = [
            'ERRO_NOCURCD' => 'Please fill Currency code.',
            'ERRO_NO_CUTOMER' => 'Please fill Customer code.',
            'ERRO_SALEORDERNO' => 'Please fill Sale Order No.',
            'WARN_CANCALEDQUOTE' => 'WARN_CANCALEDQUOTE',

            'searchcondition' => 'Search Conditions',

            'groupheader' => 'Sale Order Header Data',
            'groupcustomer' => 'Customer',
            'grouprecipient' => 'Recipient',
            'groupdetail' => 'Sale Order Details Data',
            'groupitem' => 'Sale Order Items',
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
            'validation2' => 'Please fill Item code.',
        ];

        return !empty($lang[$msg]) ? $lang[$msg] : $msg;
        
    }
?>