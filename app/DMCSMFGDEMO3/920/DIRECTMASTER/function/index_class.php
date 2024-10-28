<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class DirectMaster  {

    public function __construct() {
        $this->APPCODE = 'DIRECTMASTER';
    }

    public function search($DIRECTCD_S) {
        $Param = array( "DIRECTCD_S" => $DIRECTCD_S);
        $cmd = GetRequestData($Param, 'mas.DirectMaster.searchDir', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getDir($DIRECTCD) {
        $Param = array( "DIRECTCD" => $DIRECTCD);
        $cmd = GetRequestData($Param, 'mas.DirectMaster.getDir', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function insDir($Param) {
        $cmd = GetRequestData($Param, 'mas.DirectMaster.insertDel', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function updDir($Param) {
        $cmd = GetRequestData($Param, 'mas.DirectMaster.updateDel', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function delDir($Param) {
        $cmd = GetRequestData($Param, 'mas.DirectMaster.deleteDel', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }


}
?>