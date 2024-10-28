<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class SetAccStart extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'SETACCSTART';
    }

    public function search($ACCY, $YEAR, $MONTH, $DIVISIONCD) {
        try {
            $Param = array('ACCY' => $ACCY, 'YEAR' => $YEAR, 'MONTH' => $MONTH, 'DIVISIONCD' => $DIVISIONCD);
            $cmd = GetRequestData($Param, 'acc.AccStartAmountSetting.search', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getSum($ACCY, $YEAR, $MONTH, $DIVISIONCD) {
        try {
            $Param = array('ACCY' => $ACCY, 'YEAR' => $YEAR, 'MONTH' => $MONTH, 'DIVISIONCD' => $DIVISIONCD);
            $cmd = GetRequestData($Param, 'acc.AccStartAmountSetting.getSum', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getDiv($DIVISIONCD) {
        try {
            $Param = array('DIVISIONCD' => $DIVISIONCD);
            $cmd = GetRequestData($Param, 'acc.AccStartAmountSetting.getDiv', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function setAmount($ACCTYP, $AMT) {
        try {
            $Param = array('ACCTYP' => $ACCTYP, 'AMT' => $AMT);
            $cmd = GetRequestData($Param, 'acc.AccStartAmountSetting.setAmount', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function commit($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.AccStartAmountSetting.commit', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    public function onLoad($ACCY, $YEAR, $MONTH, $DIVISIONCD) {
        $Param = array('ACCY' => $ACCY, 'YEAR' => $YEAR, 'MONTH' => $MONTH, 'DIVISIONCD' => $DIVISIONCD);
        $cmd = GetRequestData($Param, 'acc.AccStartAmountSetting.onLoad', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.AccStartAmountSetting.onLoad', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?>