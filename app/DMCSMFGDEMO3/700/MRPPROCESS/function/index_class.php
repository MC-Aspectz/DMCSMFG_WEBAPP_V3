<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class MRPProcess {

    public function __construct() {
        $this->APPCODE = 'MRPPROCESS';
    }

// SYSTIMESTAMP,FROMDATE,TODATE,FACTORYCODE,MANUFACTURINGPRO,MANUFACTURINGTYPE,BMREPLACE
    public function createPlanV2($Param) {
        $cmd = GetRequestData($Param, 'plan.Schedule.createPlanV2', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'plan.Schedule.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?> 
