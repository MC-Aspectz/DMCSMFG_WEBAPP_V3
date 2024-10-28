<?php
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class CompanyAcoountSet {

    public function __construct() {
        $this->APPCODE = 'COMPANYACC_THA';
    }

    public function getAcc1($ACCCD1) {
        $Param = array("ACCCD1" => $ACCCD1);
        $cmd = GetRequestData($Param, 'acc.THA.CompanyAcc.getAcc1', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    public function getAcc2($ACCCD2) {
        $Param = array("ACCCD2" => $ACCCD2);
        $cmd = GetRequestData($Param, 'acc.THA.CompanyAcc.getAcc2', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    public function getAcc3($ACCCD3) {
        $Param = array("ACCCD3" => $ACCCD3);
        $cmd = GetRequestData($Param, 'acc.THA.CompanyAcc.getAcc3', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    public function getAcc4($ACCCD4) {
        $Param = array("ACCCD4" => $ACCCD4);
        $cmd = GetRequestData($Param, 'acc.THA.CompanyAcc.getAcc4', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    public function getAcc5($ACCCD5) {
        $Param = array("ACCCD5" => $ACCCD5);
        $cmd = GetRequestData($Param, 'acc.THA.CompanyAcc.getAcc5', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    public function getAccP1($ACCCDP1) {
        $Param = array("ACCCDP1" => $ACCCDP1);
        $cmd = GetRequestData($Param, 'acc.THA.CompanyAcc.getAccP1', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    public function getAccP2($ACCCDP2) {
        $Param = array("ACCCDP2" => $ACCCDP2);
        $cmd = GetRequestData($Param, 'acc.THA.CompanyAcc.getAccP2', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getAccWHT1($WHTCD1) {
        $Param = array("WHTCD1" => $WHTCD1);
        $cmd = GetRequestData($Param, 'acc.THA.CompanyAcc.getAccWHT1', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    public function getAccWHT2($WHTCD2) {
        $Param = array("WHTCD2" => $WHTCD2);
        $cmd = GetRequestData($Param, 'acc.THA.CompanyAcc.getAccWHT2', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getAccStdPay1($STDPAYMENTCD1) {
        $Param = array("STDPAYMENTCD1" => $STDPAYMENTCD1);
        $cmd = GetRequestData($Param, 'acc.THA.CompanyAcc.getAccStdPay1', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    public function getAccStdPay2($STDPAYMENTCD2) {
        $Param = array("STDPAYMENTCD2" => $STDPAYMENTCD2);
        $cmd = GetRequestData($Param, 'acc.THA.CompanyAcc.getAccStdPay2', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getAccStdRec1($STDRECEIVECD1) {
        $Param = array("STDRECEIVECD1" => $STDRECEIVECD1);
        $cmd = GetRequestData($Param, 'acc.THA.CompanyAcc.getAccStdRec1', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    public function getAccStdRec2($STDRECEIVECD2) {
        $Param = array("STDRECEIVECD2" => $STDRECEIVECD2);
        $cmd = GetRequestData($Param, 'acc.THA.CompanyAcc.getAccStdRec2', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }



    public function Updatecompacc($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.CompanyAcc.updBase', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    
    public function load() {
        $Param = array( "NOTParam" => "");
        $cmd = GetRequestData($Param, 'acc.THA.CompanyAcc.loadBase', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

}
?> 
