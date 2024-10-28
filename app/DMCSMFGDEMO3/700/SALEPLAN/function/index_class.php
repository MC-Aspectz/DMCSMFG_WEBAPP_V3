<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class SalePlan {

    public function __construct() {
        $this->APPCODE = 'SALEPLAN';
    }

    public function getStaff($STAFFCD) {
        $Param = array('STAFFCD' => $STAFFCD);
        $cmd = GetRequestData($Param, 'sale.SalePlan.getStaff', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getItem($ITEMCD) {
        $Param = array('ITEMCD' => $ITEMCD);
        $cmd = GetRequestData($Param, 'sale.SalePlan.getItem', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    // SYSTIMESTAMP,YEAR,MONTH,ITEMCD,STAFFCD,ALLOWN,STARTDT,START1,START2,START3,START4,COMPRICETYPE,COMAMOUNTTYPE
    public function DateSetHD($Param) {
        $cmd = GetRequestData($Param, 'sale.SalePlan.DateSetHD', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function search($Param) {
        $cmd = GetRequestData($Param, 'sale.SalePlan.search', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function searchLnDetailDt($Param) {
        $cmd = GetRequestData($Param, 'sale.SalePlan.searchLnDetailDt', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getDetailDT($Param) {
        $cmd = GetRequestData($Param, 'sale.SalePlan.getDetailDT', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getCustomer($CUSTOMERCD) {
        $Param = array('CUSTOMERCD' => $CUSTOMERCD);
        $cmd = GetRequestData($Param, 'sale.SalePlan.getCustomer', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getEu($ENDUSERCD) {
        $Param = array('ENDUSERCD' => $ENDUSERCD);
        $cmd = GetRequestData($Param, 'sale.SalePlan.getEu', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getMarket($MARKETCD) {
        $Param = array('MARKETCD' => $MARKETCD);
        $cmd = GetRequestData($Param, 'sale.SalePlan.getMarket', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getAmt($Param) {
        $cmd = GetRequestData($Param, 'sale.SalePlan.getAmt', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    // checkbox 4 SALEPLANTODO4FLG
    public function ctrlMemoOnClick($SALEPLANTODO4FLG, $MEMO) {
        $Param = array('SALEPLANTODO4FLG' => $SALEPLANTODO4FLG, 'MEMO' => $MEMO);
        $cmd = GetRequestData($Param, 'sale.SalePlan.ctrlMemoOnClick', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    // RUN(SEARCH2)
    public function commitLn($Param) {
        $cmd = GetRequestData($Param, 'sale.SalePlan.commitLn', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    
    public function searchAfterCommit($Param) {
        $cmd = GetRequestData($Param, 'sale.SalePlan.searchAfterCommit', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function ctrlMemoOnEntry() {
        $Param = array();
        $cmd = GetRequestData($Param, 'sale.SalePlan.ctrlMemoOnEntry', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function onClear($SYSTIMESTAMP) {
        $Param = array('SYSTIMESTAMP' => $SYSTIMESTAMP);
        $cmd = GetRequestData($Param, 'sale.SalePlan.onClear', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'sale.SaleAnalyze.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        $cmdc = GetRequestData($Param, 'acc.THA.AccPettyCashVoucherEntry.load', $this->APPCODE, '');
        $datac = Execute($cmdc, $errorMessage);
        $data['CURRENCY'] = $datac['CURRENCY1'];
        return $data;
    }

    public function ctrlAllOwn($ALLOWN) {
        $Param = array('ALLOWN' => $ALLOWN);
        $cmd = GetRequestData($Param, 'sale.SalePlan.ctrlAllOwn', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    // public function load() {
    //     $Param = array();
    //     $cmd = GetRequestData($Param, 'sale.SalePlan.load', $this->APPCODE, '');
    //     $data = getResult($cmd, $errorMessage);
    //     return $data;
    // }
}
?> 
