<?php
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class ItemIndex {

    public $P1 = '';
    public $P2 = '';
    public $P3 = '';
    public $P4 = '';
    public $P5 = '';

    public function __construct() {
        $this->APPCODE = 'SEARCHITEM';
    }

    public function searchItem($P1, $P2, $P3, $P4, $P5) {
        $Param = array("P1" => $P1, "P2" => $P2, "P3" => $P3, "P4" => $P4, "P5" => $P5);
        $cmd = GetRequestData($Param, 'search.SearchGeneral.searchItem', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 
