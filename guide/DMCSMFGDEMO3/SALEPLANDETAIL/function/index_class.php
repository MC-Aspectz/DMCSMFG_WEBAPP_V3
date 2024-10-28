<?php
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class SalePlanDetail {

    public function __construct() {
        $this->APPCODE = 'SALEPLANDETAIL';
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

    // checkbox 4 SALEPLANTODO4FLG
    public function ctrlMemoOnClick($SALEPLANTODO4FLG, $MEMO) {
        $Param = array('SALEPLANTODO4FLG' => $SALEPLANTODO4FLG, 'MEMO' => $MEMO);
        $cmd = GetRequestData($Param, 'sale.SalePlan.ctrlMemoOnClick', $this->APPCODE, '');
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
}
?> 
