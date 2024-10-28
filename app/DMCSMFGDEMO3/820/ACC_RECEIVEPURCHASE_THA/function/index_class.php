<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccReceivePurchaseTHA extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_RECEIVEPURCHASE_THA';
    }

    public function getPO($PONO) {
        try {
            $Param = array('PONO' => $PONO);
            $cmd = GetRequestData($Param, 'acc.THA.AccPurRecEntry.getPO', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getPO2($PONO) {
        try {
            $Param = array( 'PONO' => $PONO);
            $cmd = GetRequestData($Param, 'acc.THA.AccPurRecEntry.getPO2', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getPOLn($PONO) {
        try {
            $Param = array( 'PONO' => $PONO);
            $cmd = GetRequestData($Param, 'acc.THA.AccPurRecEntry.getPOLn', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getPV($PVNO) {
        $Param = array('PVNO' => $PVNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccPurRecEntry.getPV', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getPV2($PVNO) {
        try {
            $Param = array('PVNO' => $PVNO);
            $cmd = GetRequestData($Param, 'acc.THA.AccPurRecEntry.getPV2', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getPVLn($PVNO) {
        try {
            $Param = array('PVNO' => $PVNO);
            $cmd = GetRequestData($Param, 'acc.THA.AccPurRecEntry.getPVLn', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getDiv($DIVISIONCD) {
        $Param = array('DIVISIONCD' => $DIVISIONCD);
        $cmd = GetRequestData($Param, 'acc.AccPurRecEntry.getDiv', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getSupplier($SUPPLIERCD) {
        $Param = array('SUPPLIERCD' => $SUPPLIERCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccPurRecEntry.getSupplier', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getCurrency($SUPPLIERCD, $SUPCURCD) {
        $Param = array('SUPPLIERCD' => $SUPPLIERCD, 'SUPCURCD' => $SUPCURCD);
        $cmd = GetRequestData($Param, 'acc.AccPurRecEntry.getCurrency', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getStaff($STAFFCD) {
        $Param = array('STAFFCD' => $STAFFCD);
        $cmd = GetRequestData($Param, 'acc.AccPurRecEntry.getStaff', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function chkSupInvoiceDt($ADD11, $INSPDT, $ISSUEDT) {
        $Param = array('ADD11' => $ADD11, 'INSPDT' => $INSPDT, 'ISSUEDT' => $ISSUEDT);
        $cmd = GetRequestData($Param, 'acc.THA.AccPurRecEntry.chkSupInvoiceDt', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function calcIncidentalExp($SUPCURCD, $DVW) {
        $Param = array('SUPCURCD' => $SUPCURCD, 'DATA' => $DVW);
        $cmd = GetRequestData($Param, 'acc.AccPurRecEntry.calcIncidentalExp', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getVatAmt2($VATAMOUNT, $VATAMOUNT1) {
        $Param = array('VATAMOUNT' => $VATAMOUNT, 'VATAMOUNT1' => $VATAMOUNT1);
        $cmd = GetRequestData($Param, 'acc.THA.AccPurRecEntry.getVatAmt2', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getItem($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.AccPurRecEntry.getItem', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function checkDistribute($ITEMCD, $CALCIE) {
        $Param = array('ITEMCD' => $ITEMCD, 'CALCIE' => $CALCIE);
        try {
            $cmd = GetRequestData($Param, 'acc.AccPurRecEntry.checkDistribute', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function checkIEAmt($FIFOFLG, $IEAMT) {
        $Param = array('FIFOFLG' => $FIFOFLG, 'IEAMT' => $IEAMT);
        try {
            $cmd = GetRequestData($Param, 'acc.AccPurRecEntry.checkIEAmt', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getAmt($SUPPLIERCD, $SUPCURCD, $PURQTY, $PURUNITPRC, $DISCOUNT, $DISCRATE, $VATRATE) {
        try {
            $Param = array( 'SUPPLIERCD' => $SUPPLIERCD,
                            'SUPCURCD' => $SUPCURCD,
                            'PURQTY' => $PURQTY,
                            'PURUNITPRC' => $PURUNITPRC,
                            'DISCOUNT' => $DISCOUNT,
                            'DISCRATE' => $DISCRATE,
                            'VATRATE' => $VATRATE);
            $cmd = GetRequestData($Param, 'acc.AccPurRecEntry.getAmt', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.THA.AccPurRecEntry.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getVatAmtUp($VATAMOUNT2) {
        $Param = array('VATAMOUNT2' => $VATAMOUNT2);
        $cmd = GetRequestData($Param, 'acc.THA.AccPurRecEntry.getVatAmtUp', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getVatAmtDown($VATAMOUNT2) {
        $Param = array('VATAMOUNT2' => $VATAMOUNT2);
        $cmd = GetRequestData($Param, 'acc.THA.AccPurRecEntry.getVatAmtDown', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getSum($Param) {
        $cmd = GetRequestData($Param, 'acc.AccPurRecEntry.getSum', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function calculate($Param) {
        $cmd = GetRequestData($Param, 'acc.AccPurRecEntry.calculate', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function commit($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.THA.AccPurRecEntry.commit', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function cancel($PVNO, $SVNO) {
        try {
            $Param = array('PVNO' => $PVNO, 'SVNO' => $SVNO);
            $cmd = GetRequestData($Param, 'acc.THA.AccPurRecEntry.cancel', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function chk_currency($SUPCURCD) {
        $Param = array('SUPCURCD' => $SUPCURCD);
        return $this->GetReques($Param, $this->APPCODE, 'chk_currency');
    }

    public function ShowMsg1() {
        $Param = array();
        return $this->GetReques($Param, 'ACC_RECEIVEPURCHASE_THA', 'ShowMsg1');
    }

    public function checkDt($PVNO, $SUPPLIERCD, $ADD05 ,$ADD11) {
        $Param = array( 'PVNO' => $PVNO,
                        'SUPPLIERCD' => $SUPPLIERCD,
                        'ADD05' => $ADD05,
                        'ADD11' => $ADD11);
        return $this->GetReques($Param, $this->APPCODE, 'checkDt');
    }

    public function PVprintStatic($Param) {
        return $this->GetReques($Param, $this->APPCODE, 'PVprintStatic');
    }

    public function PVprintDynamic($Param) {
        return $this->GetRequesAll($Param, $this->APPCODE, 'PVprintDynamic');
    }

    public function Finished() {
        $Param = array();
        return $this->GetReques($Param, 'ACC_SALEQUOTEENTRY', 'Finished');
    }
}
