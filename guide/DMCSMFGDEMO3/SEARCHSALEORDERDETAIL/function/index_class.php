<?php
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class searchSaleOrderDetail {

    public $P1 = '';
    public $P2 = '';
    public $P3 = '';
    public $P4 = '';
    public $P5 = '';

    public function __construct() {
        $this->APPCODE = 'SEARCHSALEORDERDETAIL';
    }
    
    public function searchSaleOrderDetail($Param) {
        $cmd = GetRequestData($Param, 'search.SearchGeneral.searchSaleOrderDetail', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 
