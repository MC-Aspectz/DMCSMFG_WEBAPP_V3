<?php
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class CompanyAcoountVou {

    public function __construct() {
        $this->APPCODE = 'COMPANYACCVOU';
    }

   


    public function Updatecompaccvou($Param) {
        $cmd = GetRequestData($Param, 'acc.CompanyAcc.updVou', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    
    public function load() {
        $Param = array( "NOTParam" => "");
        $cmd = GetRequestData($Param, 'acc.CompanyAcc.loadVou', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

}
?> 
