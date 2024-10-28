<?php
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class SearchProductionOrder {

    public $P1 = '';
    public $P2 = '';
    public $P3 = '';
    public $P4 = '';
    public $P5 = '';

    public function __construct() {
        $this->APPCODE = 'SEARCHPRODUCTIONORDER';
    }
    
    public function searchProOrder($Param) {
        $cmd = GetRequestData($Param, 'search.SearchGeneral.searchProOrder', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getItem2($P3) {
        $Param = array('P3' => $P3);
        $cmd = GetRequestData($Param, 'search.SearchGeneral.getItem2', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?> 
