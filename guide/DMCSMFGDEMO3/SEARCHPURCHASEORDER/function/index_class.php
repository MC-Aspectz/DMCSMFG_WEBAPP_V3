<?php
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class PurchaseOrderIndex {

    public function __construct() {
        $this->APPCODE = 'SEARCHPURCHASEORDER';
    }

    public function getSup($P2) {
        $Param = array('P2' => $P2);
        $cmd = GetRequestData($Param, 'search.SearchGeneral.getSup', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getItem2($P3) {
        $Param = array('P3' => $P3);
        $cmd = GetRequestData($Param, 'search.SearchGeneral.getItem2', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getDiv($DIVISIONCD) {
        $Param = array('DIVISIONCD' => $DIVISIONCD);
        $cmd = GetRequestData($Param, 'search.SearchGeneral.getDiv', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function searchPurOrder($Param) {
        $cmd = GetRequestData($Param, 'search.SearchGeneral.searchPurOrder', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 
