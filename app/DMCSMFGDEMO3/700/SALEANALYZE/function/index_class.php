<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class SaleAnalyze {

    public function __construct() {
        $this->APPCODE = 'SALEANALYZE';
    }

    public function getStaff($STAFFCD) {
        $Param = array('STAFFCD' => $STAFFCD);
        $cmd = GetRequestData($Param, 'sale.SaleAnalyze.getStaff', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getItem($YEAR, $MONTH, $ITEMCD) {
        $Param = array('YEAR' => $YEAR, 'MONTH' => $MONTH, 'ITEMCD' => $ITEMCD);
        $cmd = GetRequestData($Param, 'sale.SaleAnalyze.getItem', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    // SYSTIMESTAMP,YEAR,MONTH,ONHAND,PREBALANCEQTY,PREORDERQTY,ITEMCD,ENTRYDT,FORCASTDT,PLANDT,ITEMMINSTOCK,ITEMFIXORDER,KAKUTEITORIKOM,ITEMBADRATE,FIRST_PREBALANCEQTY,FIRST_PREORDERQTY
    public function DateSet($Param) {
        $cmd = GetRequestData($Param, 'sale.SaleAnalyze.DateSet', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function search($Param) {
        $cmd = GetRequestData($Param, 'sale.SaleAnalyze.search', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function commitAll($Param) {
        $cmd = GetRequestData($Param, 'sale.SaleAnalyze.commitAll', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function makeDivData($Param) {
        $cmd = GetRequestData($Param, 'sale.SaleAnalyze.makeDivData', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    // SYSTIMESTAMP,ITEMBADRATE,DATECD1,FIRST_PREBALANCEQTY,FIRST_PREORDERQTY,CNT
    public function getScrAfterRefresh($Param) {
        $cmd = GetRequestData($Param, 'sale.SaleAnalyze.getScrAfterRefresh', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function refreshfData($Param) {
        $cmd = GetRequestData($Param, 'sale.SaleAnalyze.refreshfData', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getNextMonth($Param) {
        $cmd = GetRequestData($Param, 'sale.SaleAnalyze.getNextMonth', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getScrAfterPreNxt($Param) {
        $cmd = GetRequestData($Param, 'sale.SaleAnalyze.getScrAfterPreNxt', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getHdOnPreNxt($Param) {
        $cmd = GetRequestData($Param, 'sale.SaleAnalyze.getHdOnPreNxt', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getPreMonth($Param) {
        $cmd = GetRequestData($Param, 'sale.SaleAnalyze.getPreMonth', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function rollbackTs($SYSTIMESTAMP) {
        $Param = array('SYSTIMESTAMP' => $SYSTIMESTAMP);
        $cmd = GetRequestData($Param, 'sale.SaleAnalyze.rollbackTs', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'sale.SaleAnalyze.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?> 