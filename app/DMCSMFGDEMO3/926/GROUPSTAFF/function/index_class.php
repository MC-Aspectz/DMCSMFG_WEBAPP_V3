<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class GroupStaff extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'GROUPSTAFF';
    }

    public function searchAvailable($GROUPCD) {
        $Param = array('GROUPCD' => $GROUPCD);
        $cmd = GetRequestData($Param, 'gen.GroupStaff.searchAvailable', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function searchGrant($GROUPCD) {
        $Param = array('GROUPCD' => $GROUPCD);
        $cmd = GetRequestData($Param, 'gen.GroupStaff.searchGrant', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function grant($GROUPCD, $STAFFCD1) {
        $Param = array('GROUPCD' => $GROUPCD, 'STAFFCD1' => $STAFFCD1);
        $cmd = GetRequestData($Param, 'gen.GroupStaff.grant', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function grantAll($Param) {
        $cmd = GetRequestData($Param, 'gen.GroupStaff.grantAll', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function revoke($GROUPCD, $STAFFCD2) {
        $Param = array('GROUPCD' => $GROUPCD, 'STAFFCD2' => $STAFFCD2);
        $cmd = GetRequestData($Param, 'gen.GroupStaff.revoke', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function revokeAll($Param) {
        $cmd = GetRequestData($Param, 'gen.GroupStaff.revokeAll', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'gen.CompanySale.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?>