<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class GroupView extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'GROUP_VIEW_DMCS_THA';
    }

    public function search() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.THA.GroupRoleView.search', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function searchGrant($STAFFCD, $APPPACK) {
        $Param = array("STAFFCD" => $STAFFCD, "APPPACK" => $APPPACK);
        $cmd = GetRequestData($Param, 'acc.THA.GroupStaffRole.searchGrant', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function set($data) {
        $Param = array("DATA" => $data);
        $cmd = GetRequestData($Param, 'acc.THA.GroupRoleView.set', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?>