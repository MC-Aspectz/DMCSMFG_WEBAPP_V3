<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class GroupRole extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'GROUPROLE2_DMCS_THA';
    }

    public function getStaff($STAFFCD) {
        $Param = array("STAFFCD" => $STAFFCD);
        $cmd = GetRequestData($Param, 'gen.GroupStaffRole.getStaff', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function searchAvailable($STAFFCD, $APPPACK) {
        $Param = array("STAFFCD" => $STAFFCD, "APPPACK" => $APPPACK);
        $cmd = GetRequestData($Param, 'gen.GroupStaffRole.searchAvailable', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function searchGrant($STAFFCD, $APPPACK) {
        $Param = array("STAFFCD" => $STAFFCD, "APPPACK" => $APPPACK);
        $cmd = GetRequestData($Param, 'acc.THA.GroupStaffRole.searchGrant', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function grant($STAFFCD, $APPPACK, $APPCD1) {
        $Param = array("STAFFCD" => $STAFFCD, "APPPACK" => $APPPACK, "APPCD1" => $APPCD1);
        $cmd = GetRequestData($Param, 'gen.GroupStaffRole.grant', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function grantAll($Param) {
        $cmd = GetRequestData($Param, 'gen.GroupStaffRole.grantAll', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function revoke($STAFFCD, $APPPACK, $APPCD2) {
        $Param = array("STAFFCD" => $STAFFCD, "APPPACK" => $APPPACK, "APPCD2" => $APPCD2);
        $cmd = GetRequestData($Param, 'gen.GroupStaffRole.revoke', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function revokeAll($Param) {
        $cmd = GetRequestData($Param, 'gen.GroupStaffRole.revokeAll', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function reflect($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.GroupStaffRole.reflect', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?>