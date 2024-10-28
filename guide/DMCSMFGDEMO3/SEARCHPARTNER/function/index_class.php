<?php
require_once(dirname(__FILE__, 5) . '/common/syslogic.php');
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class Partner {

    public $P1 = '';

    public function __construct() {
        $this->APPCODE = 'SEARCHPARTNER';
    }

    public function searchPartner($P1, $P2) {
        $Param = array('P1' => $P1, 'P2' => $P2);
        $cmd = GetRequestData($Param, 'search.SearchGeneral.searchPartner', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 
