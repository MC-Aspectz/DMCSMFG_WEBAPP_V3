<?php
require_once(dirname(__FILE__, 5) . '/common/syslogic.php');
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class SearchShipTrans extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'SEARCHSHIPTRAN';
    }

    public function searchShipTran($P1) {
        $Param = array('P1' => $P1);
        $cmd = GetRequestData($Param, 'search.SearchGeneral.searchShipTran', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?> 
