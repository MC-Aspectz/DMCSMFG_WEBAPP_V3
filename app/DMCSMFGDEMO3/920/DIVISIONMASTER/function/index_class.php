<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class DivisionMaster  {

    public function __construct() {
        $this->APPCODE = 'DIVISIONMASTER';
    }

    public function search($DIVISIONTYP_S) {
        $Param = array( "DIVISIONTYP_S" => $DIVISIONTYP_S);
        $cmd = GetRequestData($Param, 'mas.DivisionMaster.searchDiv', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getDiv($DIVISIONCD) {
        $Param = array( "DIVISIONCD" => $DIVISIONCD);
        $cmd = GetRequestData($Param, 'mas.DivisionMaster.getDiv', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function insDiv($Param) {
        $cmd = GetRequestData($Param, 'mas.DivisionMaster.insDiv', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function updDiv($Param) {
        $cmd = GetRequestData($Param, 'mas.DivisionMaster.updDiv', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function delDiv($Param) {
        $cmd = GetRequestData($Param, 'mas.DivisionMaster.delDiv', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }


}
?>