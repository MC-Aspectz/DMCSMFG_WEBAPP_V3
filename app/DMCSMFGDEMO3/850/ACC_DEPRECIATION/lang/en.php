<?php

    function lang($msg) {

        $lang = [
            "clear" => "Clear",
            "close" => "Close",
            "yes" => "Yes",
            "no" => "No",
            "ok" => "Ok",
            "nono" => "No",

            "question1" => "Do you want to end this process ?",
            "question2" => "Do you want to record this data ?",

            "validation1" => "All the mandatory fields surrounded in red line need to be completed.",
            "validation2" => "Nothing to Print.",

            'complete' => 'Complete.',

        ];

        return $lang[$msg];

    }
?>
