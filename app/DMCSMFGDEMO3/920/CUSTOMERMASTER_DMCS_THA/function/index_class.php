<?php
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class CustomerMaster {

    public function __construct() {
        $this->APPCODE = 'CUSTOMERMASTER_DMCS_THA';
    }

    public function getCustomer($CUSTOMERCD) {
        $Param = array("CUSTOMERCD" => $CUSTOMERCD);
        $cmd = GetRequestData($Param, 'acc.THA.CustomerMaster.getCustomer', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getCountrycd($COUNTRYCD, $STATECD, $CITYCD) {
        $Param = array("COUNTRYCD" => $COUNTRYCD,"STATECD" => $STATECD,"CITYCD" => $CITYCD);
        $cmd = GetRequestData($Param, 'gen.TaxDetailEntry.getCity', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;       
    }

    public function getState($COUNTRYCD, $STATECD, $CITYCD) {
        $Param = array("COUNTRYCD" => $COUNTRYCD,"STATECD" => $STATECD,"CITYCD" => $CITYCD);
        $cmd = GetRequestData($Param, 'gen.TaxDetailEntry.getCity', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getCity($COUNTRYCD, $STATECD, $CITYCD) {
        $Param = array("COUNTRYCD" => $COUNTRYCD,"STATECD" => $STATECD,"CITYCD" => $CITYCD);
        $cmd = GetRequestData($Param, 'gen.TaxDetailEntry.getCity', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getCurrency($CURRENCYCD) {
        $Param = array("CURRENCYCD" => $CURRENCYCD);
        $cmd = GetRequestData($Param, 'acc.THA.CustomerMaster.getCmCur', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function insCustomer($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.CustomerMaster.insCm', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function updCustomer($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.CustomerMaster.updCm', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function delCustomer($CUSTOMERCD) {
        $Param = array("CUSTOMERCD" => $CUSTOMERCD);
        $cmd = GetRequestData($Param, 'acc.THA.CustomerMaster.delCm', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function load() {
        $Param = array( "NOTParam" => "");
        $cmd = GetRequestData($Param, 'acc.THA.AccessibleControl.setPrivilege', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?> 
