<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class accPurchaseBilling extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_PURCHASEBILLSLIP';
    }

    public function get($BILLNO) {
        try {
            $Param = array('BILLNO' => $BILLNO);
            $cmd = GetRequestData($Param, 'acc.AccPurBillSlipEntry.get', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getBSL($BILLNO) {
        try {
            $Param = array('BILLNO' => $BILLNO);
            $cmd = GetRequestData($Param, 'acc.AccPurBillSlipEntry.getPBL', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getSupplier($SUPPLIERCD) {
        try {
            $Param = array('SUPPLIERCD' => $SUPPLIERCD);
            $cmd = GetRequestData($Param, 'acc.AccPurBillSlipEntry.getSupplier', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getCurrency($SUPPLIERCD, $SUPCURCD) {
        try {
            $Param = array('SUPPLIERCD' => $SUPPLIERCD, 'SUPCURCD' => $SUPCURCD);
            $cmd = GetRequestData($Param, 'acc.AccPurBillSlipEntry.getCurrency', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getDiv($DIVISIONCD) {
        try {
            $Param = array('DIVISIONCD' => $DIVISIONCD);
            $cmd = GetRequestData($Param, 'acc.AccPurBillSlipEntry.getDiv', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function search($SUPPLIERCD, $SUPCURCD, $DIVISIONCD, $P1, $P2) {
        try {
            $Param = array('SUPPLIERCD' => $SUPPLIERCD, 'SUPCURCD' => $SUPCURCD, 'DIVISIONCD' => $DIVISIONCD, 'P1' => $P1, 'P2' => $P2);
            $cmd = GetRequestData($Param, 'acc.AccPurBillSlipEntry.search', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function commit($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.AccPurBillSlipEntry.commit', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function cancel($BILLNO) {
        try {
            $Param = array('BILLNO' => $BILLNO);
            $cmd = GetRequestData($Param, 'acc.AccPurBillSlipEntry.cancel', $this->APPCODE, '');
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