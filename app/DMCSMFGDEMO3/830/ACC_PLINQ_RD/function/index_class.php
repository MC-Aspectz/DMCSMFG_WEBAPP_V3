<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccProfitAndLossRD extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_PLINQ_RD';
    }

    public function printStatic($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.BSPLPrint_RD.printStatic', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function printDynamic($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.BSPLPrint_RD.printDynamic', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function searchCheck($Param) {
        return $this->GetRequesAll($Param,  $this->APPCODE, 'SearchCheck');
    }

    public function UpTmpRpt($DVW) {
        $Param = array("DATA" => $DVW);
        return $this->GetReques($Param,  $this->APPCODE, 'UpTmpRpt');
    }

    public function Print_PL($Param) {
        return $this->GetRequesAll($Param,  $this->APPCODE, 'Print_PL');
    }

    public function chkPrint($RPTFORMTYP) {
        $Param = array("RPTFORMTYP" => $RPTFORMTYP);
        return $this->GetReques($Param,  $this->APPCODE, 'chkPrint');
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.BSPLPrint.Load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?>