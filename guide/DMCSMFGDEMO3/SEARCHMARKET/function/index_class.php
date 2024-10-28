<?php
require_once(dirname(__FILE__, 5) . '/common/syslogic.php');
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class MarKet {

    public $P1 = '';

    public function __construct() {
        $this->APPCODE = 'SEARCHMARKET';
    }

    public function searchMarket($P1) {
        $Param = array("P1" => $P1);
        $cmd = GetRequestData($Param, 'search.SearchGeneral.searchMarket', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 
