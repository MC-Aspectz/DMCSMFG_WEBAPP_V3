<?php
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class InqProductionOrder {

    public function __construct() {
        $this->APPCODE = 'INQ_PRODUCTIONORDER_01';
    }
    
    public function getItem($ITEMCD) {
        $Param = array('ITEMCD' => $ITEMCD);
        $cmd = GetRequestData($Param, 'mas.ItemMaster.get', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

// ITEMCD,P2,P3,FACTYP,STATUS
    public function InqProductionOrder01($Param) {
        $cmd = GetRequestData($Param, 'search.SearchTransaction.InqProductionOrder01', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 
