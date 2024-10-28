<?php
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
class ASSETDEPLISTPRINT extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_ASSETDEPLISTPRINT';
    }

    

    
    public function getAssetGName1($GA1) {
        $Param = array( "GA1" => $GA1);
        return $this->GetReques($Param, $this->APPCODE, 'getAssetGName1');
    }
    
    public function getAssetGName2($GA2) {
        $Param = array( "GA2" => $GA2);
        return $this->GetReques($Param, $this->APPCODE, 'getAssetGName2');
    }
   
    public function PrintAssetDepreciationList($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.AssetDepreciationList.printStatic', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function printStatic($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.AssetDepreciationList.printStatic', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function printDynamic($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.AssetDepreciationList.printDynamic', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
?> 
