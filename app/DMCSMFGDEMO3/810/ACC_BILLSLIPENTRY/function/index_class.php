<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccBiling extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_BILLSLIPENTRY';
    }

    public function get($BILLNO) {
        try {
            $Param = array('BILLNO' => $BILLNO);
            $cmd = GetRequestData($Param, 'acc.AccBillSlipEntry.get', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getBSL($BILLNO) {
        try {
            $Param = array('BILLNO' => $BILLNO);
            $cmd = GetRequestData($Param, 'acc.AccBillSlipEntry.getBSL', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getCustomer($CUSTOMERCD) {
        try {
            $Param = array('CUSTOMERCD' => $CUSTOMERCD);
            $cmd = GetRequestData($Param, 'acc.AccBillSlipEntry.getCustomer', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getCurrency($CUSCURCD) {
        try {
            $Param = array('CUSCURCD' => $CUSCURCD);
            $cmd = GetRequestData($Param, 'acc.AccBillSlipEntry.getCurrency', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getDiv($DIVISIONCD) {
        try {
            $Param = array('DIVISIONCD' => $DIVISIONCD);
            $cmd = GetRequestData($Param, 'acc.AccBillSlipEntry.getDiv', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function search($CUSTOMERCD, $CUSCURCD, $DIVISIONCD, $P1, $P2) {
        try {
            $Param = array('CUSTOMERCD' => $CUSTOMERCD, 'CUSCURCD' => $CUSCURCD, 'DIVISIONCD' => $DIVISIONCD, 'P1' => $P1, 'P2' => $P2);
            $cmd = GetRequestData($Param, 'acc.AccBillSlipEntry.search', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function commit($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.AccBillSlipEntry.commit', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function cancel($BILLNO) {
        try {
            $Param = array('BILLNO' => $BILLNO);
            $cmd = GetRequestData($Param, 'acc.AccBillSlipEntry.cancel', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function NumberCheck($BILLNO) {
        $Param = array('BILLNO' => $BILLNO);
        return $this->GetReques($Param, $this->APPCODE, 'NumberCheck');
    }

    public function printStatic($Param) {
        return $this->GetReques($Param, $this->APPCODE, 'printStatic');
    }

    public function printDynamic($Param) {
        return $this->GetRequesAll($Param, $this->APPCODE, 'printDynamic');
    }
}
?>