<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccPurchseOrderEntryTHA extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_PURCHSEORDERENTRY_THA';
    }

    public function getPR($PRNO) {
        try {
            $Param = array('PRNO' => $PRNO);
            $cmd = GetRequestData($Param, 'acc.THA.AccPurOrderEntry.getPR', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return array('alert'=> $this->setAlert($ex->getMessage()));
        }
    }

    public function getPR2($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.AccPurOrderEntry.getPR2', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return array('alert'=> $this->setAlert($ex->getMessage()));
        }
    }

    public function getPRLn($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.AccPurOrderEntry.getPRLn', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return array('alert'=> $this->setAlert($ex->getMessage()));
        }
    }

    public function getPO($PONO) {
        $Param = array('PONO' => $PONO);
        $cmd = GetRequestData($Param, 'acc.THA.AccPurOrderEntry.getPO', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getPO2($PONO) {
        try {
            $Param = array('PONO' => $PONO);
            $cmd = GetRequestData($Param, 'acc.AccPurOrderEntry.getPO2', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return array('alert'=> $this->setAlert($ex->getMessage()));
        }
    }

    public function getPOLn($PONO) {
        try {
            $Param = array('PONO' => $PONO);
            $cmd = GetRequestData($Param, 'acc.AccPurOrderEntry.getPOLn', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return array('alert'=> $this->setAlert($ex->getMessage()));
        }
    }

    public function getDiv($DIVISIONCD) {
        $Param = array('DIVISIONCD' => $DIVISIONCD);
        $cmd = GetRequestData($Param, 'acc.AccPurOrderEntry.getDiv', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getSupplier($SUPPLIERCD) {
        $Param = array('SUPPLIERCD' => $SUPPLIERCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccPurOrderEntry.getSupplier', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getCurrency($SUPPLIERCD, $SUPCURCD) {
        $Param = array('SUPPLIERCD' => $SUPPLIERCD, 'SUPCURCD' => $SUPCURCD);
        $cmd = GetRequestData($Param, 'acc.AccPurOrderEntry.getCurrency', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getStaff($STAFFCD) {
        $Param = array('STAFFCD' => $STAFFCD);
        $cmd = GetRequestData($Param, 'acc.AccPurOrderEntry.getStaff', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getItem($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.AccPurOrderEntry.getItem', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return array('alert'=> $this->setAlert($ex->getMessage()));
        }
    }

    public function getAmt($SUPPLIERCD, $SUPCURCD, $ITEMCD, $PURQTY, $PURUNITPRC, $DISCOUNT, $DISCRATE, $VATRATE) {
        try {
            $Param = array(	'SUPPLIERCD' => $SUPPLIERCD,
			            	'SUPCURCD' => $SUPCURCD,
			            	'ITEMCD' => $ITEMCD,
			            	'PURQTY' => $PURQTY,
			            	'PURUNITPRC' => $PURUNITPRC,
			            	'DISCOUNT' => $DISCOUNT,
			            	'DISCRATE' => $DISCRATE,
			            	'VATRATE' => $VATRATE);
            $cmd = GetRequestData($Param, 'acc.AccPurOrderEntry.getAmt', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return array('alert'=> $this->setAlert($ex->getMessage()));
        }
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.THA.AccPurOrderEntry.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getSum($Param) {
        $cmd = GetRequestData($Param, 'acc.AccPurOrderEntry.getSum', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function calculate($Param) {
        $cmd = GetRequestData($Param, 'acc.AccPurOrderEntry.calculate', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function commit($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.AccPurOrderEntry.commit', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return array('alert'=> $this->setAlert($ex->getMessage()));
        }
    }

    public function cancel($PONO) {
        try {
	        $Param = array('PONO' => $PONO);
            $cmd = GetRequestData($Param, 'acc.AccPurOrderEntry.cancel', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return array('alert'=> $this->setAlert($ex->getMessage()));
        }
    }

    public function printStatic($Param) {
        return $this->GetReques($Param, 'ACC_PURCHSEORDERENTRY', 'printStatic');
    }

    public function printDynamic($Param) {
        return $this->GetRequesAll($Param, 'ACC_PURCHSEORDERENTRY', 'printDynamic');
    }

    public function Finished() {
        $Param = array();
        return $this->GetReques($Param, 'ACC_SALEQUOTEENTRY', 'Finished');
    }

    public function setAlert($msg) {
        return "<script type='text/javascript'>alert('".$msg."');</script>";
    }
}
