<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class InqSaleOrder {

    public function __construct() {
        $this->APPCODE = 'INQ_SALESORDER_01';
    }
    
    public function getCm($CUSTOMERCD) {
        $Param = array('CUSTOMERCD' => $CUSTOMERCD);
        $cmd = GetRequestData($Param, 'search.SearchTransaction.getCm', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getIm($ITEMCD) {
        $Param = array('ITEMCD' => $ITEMCD);
        $cmd = GetRequestData($Param, 'search.SearchTransaction.getIm', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getCat($CATALOGCD) {
        $Param = array('CATALOGCD' => $CATALOGCD);
        $cmd = GetRequestData($Param, 'search.SearchTransaction.getCat', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getEm1($STAFFCD) {
        $Param = array('STAFFCD' => $STAFFCD);
        $cmd = GetRequestData($Param, 'search.SearchTransaction.getEm1', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

// CUSTOMERCD,CATALOGCD,STAFFCD,P1,P2,P3,P4,P5,SALESCONFIRM,FACTORYCONFIRM,ITEMCD
    public function InqSalesOrder01($Param) {
        $cmd = GetRequestData($Param, 'search.SearchTransaction.InqSalesOrder01', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 
