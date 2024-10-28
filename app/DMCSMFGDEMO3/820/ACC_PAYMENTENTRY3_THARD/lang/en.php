<?php

    function lang($msg) {

        $lang = [
            'clear' => 'Clear',
            'close' => 'Close',
            'yes' => 'Yes',
            'no' => 'No',
            'ok' => 'Ok',
            'nono' => 'No',
            'canceled' => 'Canceled.',
            'setofdocuments' => 'Documents are issued as a set',
            'paidby' => 'PAID BY',

            'question1' => 'Do you want to end this process ?',
            'question2' => 'Do you want to cancel the data ? (After cancellation processing, data cannot be reused.)',
            'question3' => 'Do you want to record the data ?',
            'question4' => 'Do you want to print this data ?',
            'validation1' => 'All the mandatory fields surrounded in red line need to be completed.',
            'validation2' => 'Please press the issue button after entering the reason of reprint.',
            'validation3' => 'Nothing to Print.',
            'validation4' => 'Please fill supplier code.',

            'erro1' => 'The stock is less than your order, please recheck the stock and adjust its quantity.',
            'erro2' => 'There is insufficient logical inventory for the item covered by the continuous recording method. cannot be processed.',
            'erro3' => 'Item information is missing.',
            
            'success' => 'Entry into the system. General ledger already.',

            'ERRO_NOTEXISTACC' => 'Not exist Account code.',
            'ERRO_NO_PAIDDETAILS' => 'No Paid Details.',
            'ERRO_NOT_EQUAL_DEBIT_AND_CREDIT' => 'Not equal debit and credit.',
            'ERRO_AMOUNT_EQUAL_ZERO' => 'Amount equal zero.',
            'ERRO_EXISTS_ROW_NOT_SETTING_ACCOUNT' => 'Exists row not settings account.',
            'ERRO_EXISTS_ROW_AMOUNT_ZERO' => 'Exists row amount zero',

        ];

        return $lang[$msg];

    }
?>
