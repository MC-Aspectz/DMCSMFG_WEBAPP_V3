<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class MasterPlan {

    public function __construct() {
        $this->APPCODE = 'MASTERPLANVW';
    }

    public function setVw($Param) {
        $cmd = GetRequestData($Param, 'plan.MasterPlan.setVw', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function searchPlan($Param) {
        $cmd = GetRequestData($Param, 'plan.MasterPlan.search', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function changeCondition($SYSTIMESTAMP) {
        $Param = array('SYSTIMESTAMP' => $SYSTIMESTAMP);
        $cmd = GetRequestData($Param, 'plan.MasterPlan.changeCondition', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function commit($Param) {
        $cmd = GetRequestData($Param, 'plan.MasterPlan.commit', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function rollbackTs($SYSTIMESTAMP) {
        $Param = array('SYSTIMESTAMP' => $SYSTIMESTAMP);
        $cmd = GetRequestData($Param, 'plan.MasterPlan.rollbackTs', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'plan.MasterPlan.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?> 
