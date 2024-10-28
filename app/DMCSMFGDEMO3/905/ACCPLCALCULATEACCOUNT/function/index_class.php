<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class ACCPLCalculate extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACCPLCALCULATEACCOUNT';
    }

    public function search($ACCGROUPS) {
        $Param = array("ACCGROUPS" => $ACCGROUPS);
        $cmd = GetRequestData($Param, 'acc.PLCalculateMethod.search', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function searchPL($ACCGROUPS) {
        $Param = array("ACCGROUPS" => $ACCGROUPS);
        $cmd = GetRequestData($Param, 'acc.PLCalculateMethod.searchPL', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function addPLAccount($Param) {
        $cmd = GetRequestData($Param, 'acc.PLCalculateMethod.addPLAccount', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function takePLAccount($Param) {
        $cmd = GetRequestData($Param, 'acc.PLCalculateMethod.takePLAccount', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.PLCalculateMethod.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?>