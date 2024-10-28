<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class StorageMaster  {

    public function __construct() {
        $this->APPCODE = 'STORAGEMASTER';
    }

    public function search($STORAGECD_S) {
        $Param = array( "STORAGECD_S" => $STORAGECD_S);
        $cmd = GetRequestData($Param, 'mas.StorageMaster.searchStg', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getStorage($STORAGECD) {
        $Param = array( "STORAGECD" => $STORAGECD);
        $cmd = GetRequestData($Param, 'mas.StorageMaster.getStg', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getDivision($DIVISIONCD) {
        $Param = array( "DIVISIONCD" => $DIVISIONCD);
        $cmd = GetRequestData($Param, 'mas.StorageMaster.getDiv', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function insStorage($Param) {
        $cmd = GetRequestData($Param, 'mas.StorageMaster.insStg', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function updStorage($Param) {
        $cmd = GetRequestData($Param, 'mas.StorageMaster.updStg', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function delStorage($Param) {
        $cmd = GetRequestData($Param, 'mas.StorageMaster.delStg', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }


}
?>