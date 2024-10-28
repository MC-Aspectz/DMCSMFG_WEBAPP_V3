<?php
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class LocationIndex {

    public function __construct() {
        $this->APPCODE = 'SEARCHPURORPRO';
    }

    public function getItem($P1) {
        $Param = array('P1' => $P1);
        $cmd = GetRequestData($Param, 'search.SearchGeneral.getItem', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function searchPurOrPro($ODRTYP, $P1, $P2, $P3) {
        $Param = array('ODRTYP' => $ODRTYP, 'P1' => $P1, 'P2' => $P2, 'P3' => $P3);
        $cmd = GetRequestData($Param, 'search.SearchGeneral.searchPurOrPro', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 
