<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class INQPROCESS extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'INQ_PROCESS';
    }

    public function InqProcess01($P1) {
        $Param = array('P1' => $P1);
        $cmd = GetRequestData($Param, 'search.SearchTransaction.InqProcess01', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

}
?>