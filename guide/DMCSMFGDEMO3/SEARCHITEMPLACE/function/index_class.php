<?php
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class ItemIndex {

    public function __construct() {
        $this->APPCODE = 'SEARCHITEMPLACE';
    }

    public function searchItemPlace($P1, $P2) {
        $Param = array('P1' => $P1, 'P2' => $P2);
        $cmd = GetRequestData($Param, 'search.SearchGeneral.searchItemPlace', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 
