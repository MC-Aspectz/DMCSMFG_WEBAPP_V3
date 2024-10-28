<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

    class SupplierMaster extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'SUPPLIERMASTER_DMCS_THA';
    }

    public function chack_l($SUPPLIERSHORTNAME) { //Syslogic
        $Param = array("SUPPLIERSHORTNAME" => $SUPPLIERSHORTNAME);
        
        return $this->GetReques ($Param, $this->APPCODE, 'chack_l');
    }

    public function SetBranch($FACTORYCODE) { //Syslogic
        $Param = array("FACTORYCODE" => $FACTORYCODE);
        
        return $this->GetReques($Param, $this->APPCODE, 'SetBranch');
    }

    public function ChkBranch($FACTORYCODE,$SUPPLIERADD01) { //Syslogic
        $Param = array("FACTORYCODE" => $FACTORYCODE,
        "SUPPLIERADD01" => $SUPPLIERADD01);
        
        return $this->GetReques($Param, $this->APPCODE, 'ChkBranch');
    }

    public function getGMap($SUPPLIERADDR1,$SUPPLIERADDR2,$SUPPLIERZIPCODE) {
        $Param = array("SUPPLIERADDR1" => $SUPPLIERADDR1,
        "SUPPLIERADDR2" => $SUPPLIERADDR2,
        "SUPPLIERZIPCODE" => $SUPPLIERZIPCODE);
        $cmd = GetRequestData($Param, 'acc.THA.SupplierMaster.getGMap', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getSupplier($SUPPLIERCD) {
        $Param = array("SUPPLIERCD" => $SUPPLIERCD);
        $cmd = GetRequestData($Param, 'acc.THA.SupplierMaster.getSupplier', $this->APPCODE, '');
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
        $cmd = GetRequestData($Param, 'acc.THA.SupplierMaster.getSupplierCur', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getBillSupplier($SUPBILLCD) {
        $Param = array("SUPBILLCD" => $SUPBILLCD);
        $cmd = GetRequestData($Param, 'acc.THA.SupplierMaster.getBillSupplier', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function insSupplier($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.SupplierMaster.insSup', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function updSupplier($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.SupplierMaster.updSup', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function delSupplier($SUPPLIERCD) {
        $Param = array("SUPPLIERCD" => $SUPPLIERCD);
        $cmd = GetRequestData($Param, 'acc.THA.SupplierMaster.delSup', $this->APPCODE, '');
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
