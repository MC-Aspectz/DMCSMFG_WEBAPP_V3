<?php
    function language($msg) {

        $menubylang = [
            'file' => 'File', 
            'tools' => 'Tools', 
            'mainmenu' => 'Main Menu', 
            'help' => 'Help', 
            'home' => 'Home', 
            'logout' => 'Logout', 
            'changepassword' => 'Change Password', 
            'about' => 'About', 
            'manual' => 'Manual',
            'colorsettings' => 'Color Settings',
            'info' => 'Info',
            'flowchart' => 'Flowchart',

            'development' => 'Sorry, the system is under development...',
        ]; 

        return $menubylang[$msg];    
    }

?>