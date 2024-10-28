<?php
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class SalesOrderIndex {

    public function __construct() {
        $this->APPCODE = 'SEARCHSALEORDER';
    }

    public function searchSaleOrder($Param) {
        $cmd = GetRequestData($Param, 'search.SearchGeneral.searchSaleOrder', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 
