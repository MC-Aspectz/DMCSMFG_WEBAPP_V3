<?php
    function language($msg) {

        $manualmenubylang = [
            'manual' => 'Manual',
            'edit' => 'Edit', 
            'preview' => 'Preview', 
            'commit' => 'Commit', 
    		'help' => 'Help', 
    		'home' => 'Home', 
    		'logout' => 'Logout', 
    		'changepassword' => 'Change Password', 
    		'about' => 'About', 
    		'colorsettings' => 'Color Settings',
            'close' => 'Close'
        ];
            
        return $manualmenubylang[$msg];    
    }

?>