<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class PurchaseRequisition extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_PURCHASEREQUISITION_THA';
    }

    public function getPR($PURREQNO) {
        $Param = array( 'PURREQNO' => $PURREQNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccPurReqEntry.getPR', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getPRLn($PURREQNO) {
        $Param = array( 'PURREQNO' => $PURREQNO);
        $cmd = GetRequestData($Param, 'acc.AccPurReqEntry.getPRLn', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getDiv($DIVISIONCD) {
        $Param = array( 'DIVISIONCD' => $DIVISIONCD);
        $cmd = GetRequestData($Param, 'acc.AccPurReqEntry.getDiv', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getStaff($STAFFCD) {
        $Param = array( 'STAFFCD' => $STAFFCD);
        $cmd = GetRequestData($Param, 'acc.AccPurReqEntry.getStaff', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getSup($SUPCD) {
        $Param = array( 'SUPCD' => $SUPCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccPurReqEntry.getSup', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getItem($ITEMCD) {
        $Param = array( 'ITEMCD' => $ITEMCD);
        $cmd = GetRequestData($Param, 'acc.AccPurReqEntry.getItem', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function commit($Param) {
        $cmd = GetRequestData($Param, 'acc.AccPurReqEntry.commit', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function cancel($PURREQNO) {
        $Param = array( 'PURREQNO' => $PURREQNO);
        $cmd = GetRequestData($Param, 'acc.AccPurReqEntry.cancel', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function printStatic($PURREQNO) {
        $Param = array( 'PURREQNO' => $PURREQNO);
        return $this->GetReques($Param, 'ACC_PURCHASEREQUISITION', 'printStatic');
    }

    public function printDynamic($PURREQNO) {
        $Param = array( 'PURREQNO' => $PURREQNO);
        return $this->GetRequesAll($Param, 'ACC_PURCHASEREQUISITION', 'printDynamic');
    }
}
?>