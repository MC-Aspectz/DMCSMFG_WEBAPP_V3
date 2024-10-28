<?php
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class ItemLocation {

    public $P1 = '';

    public function __construct() {
        $this->APPCODE = 'SEARCHSTORAGE';
    }

    public function searchLocation($P1) {
        $Param = array("P1" => $P1);
        $cmd = GetRequestData($Param, 'search.SearchGeneral.searchStorage', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 
