<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class SearchStaffByDept extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'SEARCHSTAFFBYDEPT';
    }

    public function getStaff($STAFFDIVCD) {
        $Param = array( "STAFFDIVCD" => $STAFFDIVCD);
        $cmd = GetRequestData($Param, 'mas.StaffMaster.getDiv', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getStaffbyDept($FM0932DEPTSTART, $FM0932DEPTEND) {
        $Param = array( "FM0932DEPTSTART" => $FM0932DEPTSTART,
                        "FM0932DEPTEND" => $FM0932DEPTEND);
        return $this->GetReques($Param, $this->APPCODE, 'getStaffbyDepartment');
    }
}
?>