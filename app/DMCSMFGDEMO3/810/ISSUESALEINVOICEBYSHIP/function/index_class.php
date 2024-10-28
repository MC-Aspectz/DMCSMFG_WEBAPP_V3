<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class IssueSaleInvoiceByShip extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ISSUESALEINVOICEBYSHIP';
    }

    public function getCustomer($CUSTOMERCD) {
        $Param = array('CUSTOMERCD' => $CUSTOMERCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccIssueSaleInvoiceByShip.getCustomer', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function Search($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.AccIssueSaleInvoiceByShip.Search', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function SelectShip($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.AccIssueSaleInvoiceByShip.SelectShip', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function setSelectedShipping($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.AccIssueSaleInvoiceByShip.setSelectedShipping', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function setInvoiceItems($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.AccIssueSaleInvoiceByShip.setInvoiceItems', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getSaleTran($SALETRANNO) {
        $Param = array('SALETRANNO' => $SALETRANNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccIssueSaleInvoiceByShip.getSaleTran', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getSaleTranLn($SALETRANNO) {
        $Param = array('SALETRANNO' => $SALETRANNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccIssueSaleInvoiceByShip.getSaleTranLn', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getSaleTranShip($SALETRANNO) {
        $Param = array('SALETRANNO' => $SALETRANNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccIssueSaleInvoiceByShip.getSaleTranShip', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getDivision($DIVISIONCD) {
        $Param = array('DIVISIONCD' => $DIVISIONCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccIssueSaleInvoiceByShip.getDiv', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getStaff($STAFFCD) {
        $Param = array('STAFFCD' => $STAFFCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccIssueSaleInvoiceByShip.getStaff', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getCurrency($CUSCURCD) {
        $Param = array('CUSCURCD' => $CUSCURCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry.getCurrency', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    // DVW,VATRATE,DISCRATE,CUSTOMERCD,CUSCURCD
    public function calculateInv($Param) {  // when Vat and discount
        $cmd = GetRequestData($Param, 'acc.THA.AccIssueSaleInvoiceByShip.calculateInv', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
    // DVW,VATRATE,DISCRATE,CUSTOMERCD,CUSCURCD
    public function getSumInv($Param) {// when Vat and discount
        $cmd = GetRequestData($Param, 'acc.THA.AccIssueSaleInvoiceByShip.getSumInv', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
    // CUSTOMERCD,CUSCURCD,ITEMCD,SALEQTY,SALEUNITPRC,SALEDISCOUNT,DISCRATE,VATRATE
    public function getAmtInv($Param) { // Table run cal
        $cmd = GetRequestData($Param, 'acc.THA.AccIssueSaleInvoiceByShip.getAmtInv', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function commit($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.AccIssueSaleInvoiceByShip.commit', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function replace($SALETRANNO) {
        $Param = array('SALETRANNO' => $SALETRANNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccIssueSaleInvoiceByShip.replace', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function printInv($SALETRANNO) { // Invoice
        $Param = array('SALETRANNO' => $SALETRANNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccIssueSaleInvoiceByShip.printInv', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function checkPrintFlg($SALETRANNO) { // Invoice TAXInvoice
        $Param = array('SALETRANNO' => $SALETRANNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccIssueSaleInvoiceByShip.checkPrintFlg', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function IVprintCheck($SALETRANNO, $REPRINTREASON) { // TAXInvoice
        $Param = array( 'SALETRANNO' => $SALETRANNO, 'REPRINTREASON' => $REPRINTREASON);
        $cmd = GetRequestData($Param, 'acc.THA.AccIssueSaleInvoiceByShip.IVprintCheck', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function printTaxInv($SALETRANNO, $REPRINTREASON) { // TAXInvoice
        $Param = array( 'SALETRANNO' => $SALETRANNO, 'REPRINTREASON' => $REPRINTREASON);
        $cmd = GetRequestData($Param, 'acc.THA.AccIssueSaleInvoiceByShip.printTaxInv', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function printVoucher($SALETRANNO, $SVNO) { // Voucher
        $Param = array( 'SALETRANNO' => $SALETRANNO, 'SVNO' => $SVNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccIssueSaleInvoiceByShip.printVoucher', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.THA.AccIssueSaleInvoiceByShip.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function lockShipping() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.THA.AccIssueSaleInvoiceByShip.lockShipping', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function unlockShipping() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.THA.AccIssueSaleInvoiceByShip.unlockShipping', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function unlockForm() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.THA.AccIssueSaleInvoiceByShip.unlockForm', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function setSaleDivCon2($SALEDIVCON2CBO) {
        $Param = array('SALEDIVCON2CBO' => $SALEDIVCON2CBO);
        return $this->GetReques($Param, $this->APPCODE, 'setSaleDivCon2');
    }
}