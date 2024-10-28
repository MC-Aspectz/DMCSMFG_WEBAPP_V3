<?php
    function lang($msg) {

        $lang = [
            'itemmaster' => 'Item Master',
            'itemindex' => 'Item Index', 

            'searchcondition' => 'Search Conditions',

            'groupitem' => 'Search, Specification, Material',
            'grouptype' => 'BOI, Type, Category',
            'groupunit' => 'Unit, Packaging, Capacity, Weight',
            'grouppurchase' => 'Purchase',
            'groupsale' => 'Sale',
            'groupinventory' => 'Inventory',
            'groupimage' => 'Item Image',
            'groupworkcenter' => 'Work Center, Cost Option',
            'gruopcheckbox' => 'FIFO List, Phantom Item, No Inventory Control, Manufacturing Plan, Serial No. Control',

            'yes' => 'Yes',
            'no' => 'No',
            'close' => 'Close',

            'question1' => 'Do you want to end this process ?',
            'validation1' => 'All the mandatory fields surrounded in red line need to be completed.',
        ];

        return !empty($lang[$msg]) ? $lang[$msg] : $msg;
    }
?>
