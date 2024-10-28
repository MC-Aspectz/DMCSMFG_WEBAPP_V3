<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class COMPANYSALE extends Syslogic{

    public function __construct() {
        $this->APPCODE = 'COMPANYSALE';
    }
    //gen.CompanySale.upd
    public function upd($Param) {
        $cmd = GetRequestData($Param, 'gen.CompanySale.upd', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    //gen.CompanySale.load
    public function load() {
        $Param = array( "NOTParam" => "");
        $cmd = GetRequestData($Param, 'gen.CompanySale.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    
}
?> 
