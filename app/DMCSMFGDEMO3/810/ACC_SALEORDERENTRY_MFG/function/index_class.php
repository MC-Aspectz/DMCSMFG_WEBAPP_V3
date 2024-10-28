<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class SalesOrderEntryMFG extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_SALEORDERENTRY_MFG';
    }

    public function setSearchCustomer($SERCUSTCD) {
        $Param = array('SERCUSTCD' => $SERCUSTCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleOrderEntry_MFG.getSearchCustomer', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getSearchStaff($SERSTAFFCD) {
        $Param = array('SERSTAFFCD' => $SERSTAFFCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleOrderEntry_MFG.getSearchStaff', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function searchSO($SERSONO1, $SERSONO2, $SERINPDATE1, $SERINPDATE2, $SERCUSTCD, $SERSTAFFCD) {
        $Param = array( 'SERSONO1' => $SERSONO1,
                        'SERSONO2' => $SERSONO2,
                        'SERINPDATE1' => !empty($SERINPDATE1) ? str_replace('-', '', $SERINPDATE1): '',
                        'SERINPDATE2' => !empty($SERINPDATE2) ? str_replace('-', '', $SERINPDATE2): '',
                        'SERCUSTCD' => $SERCUSTCD,
                        'SERSTAFFCD' => $SERSTAFFCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleOrderEntry_MFG.SearchSO', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getEst($ESTNO) {
        $Param = array('ESTNO' => $ESTNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleOrderEntry_MFG.getEst', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getDivision($DIVISIONCD) {
        $Param = array('DIVISIONCD' => $DIVISIONCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleOrderEntry_MFG.getDiv', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getSO($SALEORDERNO) {
        $Param = array('SALEORDERNO' => $SALEORDERNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleOrderEntry_MFG.getSO', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getSOLn($SALEORDERNO) {
        $Param = array('SALEORDERNO' => $SALEORDERNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleOrderEntry_MFG.getSOLn', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getEstLn($ESTNO, $SALEORDERNO) {
        $Param = array('ESTNO' => $ESTNO, 'SALEORDERNO' => $SALEORDERNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleOrderEntry_MFG.getEstLn', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getCustomer($CUSTOMERCD) {
        $Param = array('CUSTOMERCD' => $CUSTOMERCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleOrderEntry_MFG.getCustomer', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getStaff($STAFFCD) {
        $Param = array('STAFFCD' => $STAFFCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleOrderEntry_MFG.getStaff', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getCurrency($CUSCURCD) {
        $Param = array('CUSCURCD' => $CUSCURCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleOrderEntry_MFG.getCurrency', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getItem($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleOrderEntry_MFG.getItem', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getDel($DELIVERYCD) {
        $Param = array('DELIVERYCD' => $DELIVERYCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleOrderEntry_MFG.getDel', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function commit($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleOrderEntry_MFG.commit', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function cancel($SALEORDERNO) {
        $Param = array('SALEORDERNO' => $SALEORDERNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleOrderEntry_MFG.cancel', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function printStatic($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleOrderEntry_MFG.printStatic', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function printDynamic($SALEORDERNO) {
        $Param = array('SALEORDERNO' => $SALEORDERNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleOrderEntry_MFG.printDynamic', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleOrderEntry_MFG.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    // DVW,VATRATE,DISCRATE,CUSTOMERCD,CUSCURCD
    public function calculate($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleOrderEntry_MFG.calculate, THA.AccSaleOrderEntry_MFG.getSum', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    // DVW,VATRATE,DISCRATE,CUSTOMERCD,CUSCURCD
    public function getSum($Param) {
        $cmd = GetRequestData($Param, 'THA.AccSaleOrderEntry_MFG.getSum', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function Finished() {
        $Param = array();
        return $this->GetReques($Param, 'ACC_SALEORDERENTRY_MFG', 'Finished');
    }

    public function DisCTRL() {
        $Param = array();
        return $this->GetReques($Param, 'ACC_SALEORDERENTRY_MFG', 'DisCTRL');
    }
}