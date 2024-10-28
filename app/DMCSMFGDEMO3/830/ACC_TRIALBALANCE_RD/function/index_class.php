<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccTrialBalanceRD extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_TRIALBALANCE_RD';
    }

    public function getDiv($DIVISIONCD) {
        try {
            $Param = array('DIVISIONCD' => $DIVISIONCD);
            $cmd = GetRequestData($Param, 'acc.TrialBalancePrint.getDiv', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function printStatic($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.TrialBalancePrint_RD.printStatic', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function printDynamic($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.TrialBalancePrint_RD.printDynamic', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function searchCheck($Param) {
        return $this->GetReques($Param,  $this->APPCODE, 'SearchCheck');
    }

	// DVW = ACCOUNTCODE,ACCOUNTNAME,BIGINING_D,BIGINING_C,PERIOD_D,PERIOD_C,ENDING_D,ENDING_C,CURRENCYDUMMY
    public function UpTmpRpt($DVW) {
    	$Param = array('DATA' => $DVW);
        return $this->GetReques($Param,  $this->APPCODE, 'UpTmpRpt');
    }

    public function Print_TB($Param) {
        return $this->GetRequesAll($Param,  $this->APPCODE, 'Print_TB');
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.TrialBalancePrint.Load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?>