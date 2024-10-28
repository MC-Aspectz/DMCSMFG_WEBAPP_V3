<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class GroupRole extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'GROUPROLE_DMCS_THA';
    }

    public function searchAvailable($GROUPCD, $APPPACK) {
        $Param = array('GROUPCD' => $GROUPCD, 'APPPACK' => $APPPACK);
        $cmd = GetRequestData($Param, 'gen.GroupRole.searchAvailable', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function searchGrant($GROUPCD, $APPPACK) {
        $Param = array('GROUPCD' => $GROUPCD, 'APPPACK' => $APPPACK);
        $cmd = GetRequestData($Param, 'acc.THA.GroupRole.searchGrant', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function grant($GROUPCD, $APPPACK, $APPCD1) {
        $Param = array('GROUPCD' => $GROUPCD, 'APPPACK' => $APPPACK, 'APPCD1' => $APPCD1);
        $cmd = GetRequestData($Param, 'gen.GroupRole.grant', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function grantAll($Param) {
        $cmd = GetRequestData($Param, 'gen.GroupRole.grantAll', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function revoke($GROUPCD, $APPPACK, $APPCD2) {
        $Param = array('GROUPCD' => $GROUPCD, 'APPPACK' => $APPPACK, 'APPCD2' => $APPCD2);
        $cmd = GetRequestData($Param, 'gen.GroupRole.revoke', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function revokeAll($Param) {
        $cmd = GetRequestData($Param, 'gen.GroupRole.revokeAll', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function reflect($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.GroupRole.reflect', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?>