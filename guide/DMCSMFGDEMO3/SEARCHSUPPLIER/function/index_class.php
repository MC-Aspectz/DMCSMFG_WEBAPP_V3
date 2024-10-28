<?php
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class ItemSupplier {

    public $P1 = '';
    public $P2 = '';

    public function __construct() {
        $this->APPCODE = 'SEARCHSUPPLIER';
    }

    public function searchSupplier($P1, $P2) {
        $Param = array('P1' => $P1, 'P2' => $P2);
        $cmd = GetRequestData($Param, 'search.SearchGeneral.searchSupplier', '', '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 
