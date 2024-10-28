<?php
    function lang($msg) {

        $lang = [
            'close' => 'Close', 
            'yes' => 'Yes',
            'no' => 'No',

            'question1' => 'Do you want to end this process ?',

            'validation1' => 'All the mandatory fields surrounded in red line need to be completed.',

            'ERRORUNCHECK' => 'The process is currently used by another computer.',

            'ERRO_CLEARANCE_DATE' => 'Stocktake date not in Reference Period.',
        ];
            
        return $lang[$msg];    
    }

?>