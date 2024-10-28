<?php
require_once(dirname(__FILE__, 5) . '/common/syslogic.php');
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class ShippingLocationIndex extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'SEARCHDELIVERY';
    }

    public function searchDelivery($P1, $P2) {
        $Param = array('P1' => $P1, 'P2' => $P2);
        $cmd = GetRequestData($Param, 'search.SearchGeneral.searchDelivery', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?> 
