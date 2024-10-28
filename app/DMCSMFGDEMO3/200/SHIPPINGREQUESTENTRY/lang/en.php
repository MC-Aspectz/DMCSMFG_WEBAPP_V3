<?php
    function lang($msg) {

        $lang = [
            'close' => 'Close', 
            'yes' => 'Yes',
            'no' => 'No',

            'question1' => 'Do you want to end this process ?',

            'validation1' => 'All the mandatory fields surrounded in red line need to be completed.',
            'validation2' => 'The value entered is larger than the requested shipment balance. Do you want to proceed ?',

        ];
            
        return $lang[$msg];    
    }

?>