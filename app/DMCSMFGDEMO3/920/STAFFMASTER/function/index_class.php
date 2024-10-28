<?php
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class StaffMaster {

    public function __construct() {
        $this->APPCODE = 'STAFFMASTER';
    }

    public function getStaff($STAFFCD) {
        $Param = array("STAFFCD" => $STAFFCD);
        $cmd = GetRequestData($Param, 'mas.StaffMaster.get', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getDivison($DIVISIONCD) {
        $Param = array("DIVISIONCD" => $DIVISIONCD);
        $cmd = GetRequestData($Param, 'mas.StaffMaster.getDiv', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;       
    }


    public function insStaff($Param) {
        $cmd = GetRequestData($Param, 'mas.StaffMaster.insStaff', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function updStaff($Param) {
        $cmd = GetRequestData($Param, 'mas.StaffMaster.updStaff', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function delStaff($STAFFCD) {
        $Param = array("STAFFCD" => $STAFFCD);
        $cmd = GetRequestData($Param, 'mas.StaffMaster.delStaff', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function load() {
        $Param = array( "NOTParam" => "");
        $cmd = GetRequestData($Param, 'acc.THA.AccessibleControl.setPrivilege', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?> 
