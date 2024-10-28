<?php
require_once(dirname(__FILE__, 5) . '/common/syslogic.php');
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class SearchBank extends Syslogic {

    public $P1 = '';

    public function __construct() {
        $this->APPCODE = 'SEARCHBANK';
    }

    // search.SearchGeneral.searchBank  P1
    public function searchBank($P1) {
        $Param = array( "P1" => $P1);
        $cmd = GetRequestData($Param, 'search.SearchGeneral.searchBank', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

}
?> 
