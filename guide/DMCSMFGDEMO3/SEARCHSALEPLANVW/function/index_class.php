<?php
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class SearchSalePlan {

    public $P1 = '';
    public $P2 = '';
    public $P3 = '';


    public function __construct() {
        $this->APPCODE = 'SEARCHSALEPLANVW';
    }

    public function searchSalePlanVw($ITEMCD, $STAFFCD, $SALEDT, $ALLOWN) {
        $Param = array('ITEMCD' => $ITEMCD, 'STAFFCD' => $STAFFCD, 'SALEDT' => $SALEDT, 'ALLOWN' => $ALLOWN);
        $cmd = GetRequestData($Param, 'search.SearchGeneral.searchSalePlanVw', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 
