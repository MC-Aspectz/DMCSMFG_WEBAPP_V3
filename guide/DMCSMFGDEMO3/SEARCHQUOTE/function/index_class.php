<?php
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class QuoteIndex {

    public function __construct() {
        $this->APPCODE = 'SEARCHQUOTE';
    }

    public function getCus($P1) {
        $Param = array('P1' => $P1);
        $cmd = GetRequestData($Param, 'search.SearchGeneral.getCus', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function searchQuote($P1, $P2, $P3, $P4, $P5) {
        $Param = array('P1' => $P1, 'P2' => $P2, 'P3' => $P3, 'P4' => $P4, 'P5' => $P5);
        $cmd = GetRequestData($Param, 'search.SearchGeneral.searchQuote', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 
