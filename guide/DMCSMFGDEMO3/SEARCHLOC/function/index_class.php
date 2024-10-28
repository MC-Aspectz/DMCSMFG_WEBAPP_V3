<?php
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class LocationIndex {

    public function __construct() {
        $this->APPCODE = 'SEARCHLOC';
    }

    public function searchLoc($P1, $P2) {
        $Param = array('P1' => $P1, 'P2' => $P2);
        $cmd = GetRequestData($Param, 'search.SearchGeneral.searchLoc', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 