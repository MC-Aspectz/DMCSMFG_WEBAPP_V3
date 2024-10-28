<?php
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class CompanyMaster {

    public function __construct() {
        $this->APPCODE = 'COMPANYMASTER_THA';
    }

    
    public function getCountrycd($COUNTRYCD) {
        $Param = array("COUNTRYCD" => $COUNTRYCD);
        $cmd = GetRequestData($Param, 'gen.CompanyMaster.getCountry', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;       
    }

    public function getCurrency($CURRENCY) {
        $Param = array("CURRENCY" => $CURRENCY);
        $cmd = GetRequestData($Param, 'gen.CompanyMaster.getCur', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

   // gen.THA.CompanyMaster.upd





   public function SETACCYEARVAL($param) {
   // $Param = array("M_SET" => $M_SET);
    $cmd = GetRequestData($param, 'gen.THA.CompanyMaster.setAccYearValue', $this->APPCODE, '');
    $data = Execute($cmd, $errorMessage);
    return $data;
}

    public function Updatecomp($Param) {
        $cmd = GetRequestData($Param, 'gen.THA.CompanyMaster.upd', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    
    public function load() {
        $Param = array( "NOTParam" => "");
        $cmd = GetRequestData($Param, 'gen.THA.CompanyMaster.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

}
?> 
