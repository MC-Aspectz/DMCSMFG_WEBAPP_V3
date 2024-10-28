<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccSaleEntryMFG extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_SALEENTRY_THA3_MFG';
    }

    public function getST($SALETRANNO) {
        $Param = array('SALETRANNO' => $SALETRANNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry3MFG.getST', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getST2($SALETRANNO) {
        $Param = array('SALETRANNO' => $SALETRANNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry3MFG.getST2', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getSO($SALEORDERNO) {
        $Param = array('SALEORDERNO' => $SALEORDERNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry3MFG.getSO', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getSO2($SALEORDERNO, $SALETRANNO) {
        $Param = array('SALEORDERNO' => $SALEORDERNO, 'SALETRANNO' => $SALETRANNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry3MFG.getSO2', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getDivision($DIVISIONCD) {
        $Param = array('DIVISIONCD' => $DIVISIONCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry3MFG.getDiv', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getAmt($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry3MFG.getAmt', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getSTLn($SALETRANNO) {
        $Param = array('SALETRANNO' => $SALETRANNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry3MFG.getSTLn', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getSOLn($SALEORDERNO, $SALETRANNO) {
        $Param = array('SALEORDERNO' => $SALEORDERNO, 'SALETRANNO' => $SALETRANNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry3MFG.getSOLn', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getCustomer($CUSTOMERCD) {
        $Param = array('CUSTOMERCD' => $CUSTOMERCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry3MFG.getCustomer', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getStaff($STAFFCD) {
        $Param = array('STAFFCD' => $STAFFCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry3MFG.getStaff', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getCurrency($CUSCURCD) {
        $Param = array('CUSCURCD' => $CUSCURCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry3MFG.getCurrency', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getItem($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry3MFG.getItem', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry3MFG3MFG.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getSum() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry3MFG.getSum', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function commit($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry3MFG.commit', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function replace($SALETRANNO) {
        $Param = array('SALETRANNO' => $SALETRANNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry3MFG.replace', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
    
    public function printInv($SALETRANNO) { // Invoice
        $Param = array('SALETRANNO' => $SALETRANNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry3MFG.printInv', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function checkPrintFlg($SALETRANNO) { // Invoice TAXInvoice
        $Param = array('SALETRANNO' => $SALETRANNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry3MFG.checkPrintFlg', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function IVprintCheck($SALETRANNO, $REPRINTREASON) { // TAXInvoice
        $Param = array( 'SALETRANNO' => $SALETRANNO, 'REPRINTREASON' => $REPRINTREASON);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry3MFG.IVprintCheck', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function printTaxInv($SALETRANNO, $REPRINTREASON) { // TAXInvoice
        $Param = array( 'SALETRANNO' => $SALETRANNO, 'REPRINTREASON' => $REPRINTREASON);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry3MFG.printTaxInv', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function printVoucher($SALETRANNO, $SVNO) { // Voucher
        $Param = array( 'SALETRANNO' => $SALETRANNO, 'SVNO' => $SVNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry3MFG.printVoucher', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function setSaleDivCon2($SALEDIVCON2CBO) {
        $Param = array('SALEDIVCON2CBO' => $SALEDIVCON2CBO);
        return $this->GetReques($Param, $this->APPCODE, 'setSaleDivCon2');
    }
}