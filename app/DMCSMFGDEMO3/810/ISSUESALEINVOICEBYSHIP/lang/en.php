<?php
    function lang($msg) {

        $lang = [
            'clear' => 'Clear',
            'close' => 'Close',
            'ERRO_NOCURCD' => 'ERRO_NOCURCD',
            'ERRO_NO_CUTOMER' => 'ERRO_NO_CUTOMER',
            'ERRO_SALEORDERNO' => 'ERRO_SALEORDERNO',
            'WARN_CANCALEDQUOTE' => 'WARN_CANCALEDQUOTE',
            'yes' => 'Yes',
            'no' => 'No',
            'ok' => 'Ok',
            'nono' => 'No',
            'canceled' => 'Canceled.',
            'setofdocuments' => 'Documents are issued as a set',
            'selectshipping' => 'Select Shipping to Issue Invoice',
            'invoicesalevoucher' => 'Invoice / Sale Voucher Entry',

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
