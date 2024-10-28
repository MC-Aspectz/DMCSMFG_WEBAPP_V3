<?php
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class CustomizeCopy {

    public function __construct() {
        $this->APPCODE = 'CUSTOMIZECOPY';
    }

    
    public function getApp($APPID) {
        $Param = array("APPID" => $APPID);
        $cmd = GetRequestData($Param, 'gen.ApplicationCopy.getApp', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
       
    }


    public function COPY($Param) {
        $cmd = GetRequestData($Param, 'gen.ApplicationCopy.copy', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
       
    }


 

}
?> 
