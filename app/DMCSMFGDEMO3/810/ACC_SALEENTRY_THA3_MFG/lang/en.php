<?php
    function lang($msg) {

        $lang = [
            'ERRO_NOCURCD' => 'ERRO_NOCURCD',
            'ERRO_NO_CUTOMER' => 'ERRO_NO_CUTOMER',
            'ERRO_SALEORDERNO' => 'ERRO_SALEORDERNO',
            'WARN_CANCALEDQUOTE' => 'WARN_CANCALEDQUOTE',

            'searchcondition' => 'Search Conditions',

            'groupheader' => 'Invoice / Sale Voucher Header Data',
            'groupcustomer' => 'Customer',
            'groupdetail' => 'Invoice / Sale Voucher Details Data',
            'groupitem' => 'Invoice / Sale Voucher Items',
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
            'validation2' => 'Please press the issue button after entering the reason of reprint.',
            
            'erro1' => 'The stock is less than your order, please recheck the stock and adjust its quantity.',
            'erro2' => 'There is insufficient logical inventory for the item covered by the continuous recording method. cannot be processed.',
            'erro3' => 'Item information is missing.',
            
            'success' => 'Entry into the system. General ledger already.',
        ];
        
        return !empty($lang[$msg]) ? $lang[$msg] : $msg;

    }
?>