<?php
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class DirectMaster {

    public $P1 = '';

    public function __construct() {
        $this->APPCODE = 'SEARCHDIRECT';
    }

    public function searchDirect($P1) {
        $Param = array("P1" => $P1);
        $cmd = GetRequestData($Param, 'search.SearchGeneral.searchDirect', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 
