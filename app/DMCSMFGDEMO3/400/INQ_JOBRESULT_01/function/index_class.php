<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class InqJobResult extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'INQ_JOBRESULT_01';
    }

    public function InqJobResult01($P1, $P2) {
        $Param = array('P1' => $P1, 'P2' => $P2);
        $cmd = GetRequestData($Param, 'search.SearchTransaction.InqJobResult01', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 


