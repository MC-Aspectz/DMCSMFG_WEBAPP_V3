<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccAdjustVoucherTHA extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_ADJUSTVO_THA';
    }

    public function getHeader($BOOKORDERNO) {
        try {
            $Param = array('BOOKORDERNO' => $BOOKORDERNO);
            $cmd = GetRequestData($Param, 'acc.THA.AccAdjustVoucherEntryRD.getHeader', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getDetail($BOOKORDERNO, $ACCY, $I_CURRENCY, $CURRENCY1) {
        try {
            $Param = array('BOOKORDERNO' => $BOOKORDERNO, 'ACCY' => $ACCY, 'I_CURRENCY' => $I_CURRENCY, 'CURRENCY1' => $CURRENCY1);
            $cmd = GetRequestData($Param, 'acc.AccAdjustVoucherEntryRD.getDetail', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getRefHeader($REFBOOKORDERNO) {
        try {
            $Param = array('REFBOOKORDERNO' => $REFBOOKORDERNO);
            $cmd = GetRequestData($Param, 'acc.THA.AccAdjustVoucherEntryRD.getRefHeader', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getRefDetail($REFBOOKORDERNO, $ACCY, $I_CURRENCY, $CURRENCY1) {
        try {
            $Param = array('REFBOOKORDERNO' => $REFBOOKORDERNO, 'ACCY' => $ACCY, 'I_CURRENCY' => $I_CURRENCY, 'CURRENCY1' => $CURRENCY1);
            $cmd = GetRequestData($Param, 'acc.AccAdjustVoucherEntryRD.getRefDetail', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getInpStf($INP_STFCD) {
        try {
            $Param = array('INP_STFCD' => $INP_STFCD);
            $cmd = GetRequestData($Param, 'acc.AccAdjustVoucherEntryRD.getInpStf', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getDiv($DIVISIONCD) {
        try {
            $Param = array('DIVISIONCD' => $DIVISIONCD);
            $cmd = GetRequestData($Param, 'acc.AccAdjustVoucherEntryRD.getDiv', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function setCss($CSSTYPE) {
        try {
            $Param = array('CSSTYPE' => $CSSTYPE);
            $cmd = GetRequestData($Param, 'acc.THA.AccAdjustVoucherEntryRD.setCss', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getStaff($STAFFCODE) {
        try {
            $Param = array('STAFFCODE' => $STAFFCODE);
            $cmd = GetRequestData($Param, 'acc.AccAdjustVoucherEntryRD.getStaff', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getSupllier($SUPPLIERCD) {
        try {
            $Param = array('SUPPLIERCD' => $SUPPLIERCD);
            $cmd = GetRequestData($Param, 'acc.AccAdjustVoucherEntryRD.getSupllier', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getCustomer($CUSTOMERCODE) {
        try {
            $Param = array('CUSTOMERCODE' => $CUSTOMERCODE);
            $cmd = GetRequestData($Param, 'acc.THA.AccAdjustVoucherEntryRD.getCustomer', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function chkAccCd($ACC_CD, $CSSTYPE, $SUPPLIERCD) {
        try {
            $Param = array('ACC_CD' => $ACC_CD, 'CSSTYPE' => $CSSTYPE, 'SUPPLIERCD' => $SUPPLIERCD);
            $cmd = GetRequestData($Param, 'acc.AccAdjustVoucherEntryRD.chkAccCd', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getAmt($AMT, $DC_TYPE, $EXRATE) {
        try {
            $Param = array('AMT' => $AMT, 'DC_TYPE' => $DC_TYPE, 'EXRATE' => $EXRATE);
            $cmd = GetRequestData($Param, 'acc.AccAdjustVoucherEntryRD.getAmt', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getAcc($DC_TYPE, $ACC_CD, $AMT, $I_CURRENCY, $CURRENCY1, $EXRATE) {
        try {
            $Param = array('DC_TYPE' => $DC_TYPE, 'ACC_CD' => $ACC_CD, 'AMT' => $AMT, 'I_CURRENCY' => $I_CURRENCY, 'CURRENCY1' => $CURRENCY1, 'EXRATE' => $EXRATE);
            $cmd = GetRequestData($Param, 'acc.AccAdjustVoucherEntryRD.getAcc', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getExRate($I_CURRENCY, $CURRENCY1, $AMT, $DC_TYPE, $ISSUEDATE) {
        try {
            $Param = array('I_CURRENCY' => $I_CURRENCY, 'CURRENCY1' => $CURRENCY1, 'AMT' => $AMT, 'DC_TYPE' => $DC_TYPE, 'ISSUEDATE' => $ISSUEDATE);
            $cmd = GetRequestData($Param, 'acc.AccAdjustVoucherEntryRD.getExRate', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function commitRemark($ACCTRANREMARK) {
        try {
            $Param = array('ACCTRANREMARK' => $ACCTRANREMARK);
            $cmd = GetRequestData($Param, 'acc.AccAdjustVoucherEntryRD.commitRemark', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getRecur($RECURCD) {
        try {
            $Param = array('RECURCD' => $RECURCD);
            $cmd = GetRequestData($Param, 'acc.AccAdjustVoucherEntryRD.getRecur', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function searchRecur($RECURCD) {
        try {
            $Param = array('RECURCD' => $RECURCD);
            $cmd = GetRequestData($Param, 'acc.AccAdjustVoucherEntryRD.searchRecur', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function commitRecurring($RECURCD, $DVWDETAIL) {
        try {
            $Param = array('RECURCD' => $RECURCD, 'DVWDETAIL' => $DVWDETAIL);
            $cmd = GetRequestData($Param, 'acc.AccAdjustVoucherEntryRD.commitRecurring', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function chkCommitData($TTL_AMT1, $TTL_AMT2) {
        try {
            $Param = array('TTL_AMT1' => $TTL_AMT1, 'TTL_AMT2' => $TTL_AMT2);
            $cmd = GetRequestData($Param, 'acc.AccAdjustVoucherEntryRD.chkCommitData', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    public function commit($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.AccAdjustVoucherEntryRD.commit', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
   
    public function JVprintCheck($BOOKORDERNO, $REPRINTREASON) {
        try {
            $Param = array('BOOKORDERNO' => $BOOKORDERNO, 'REPRINTREASON' => $REPRINTREASON);
            $cmd = GetRequestData($Param, 'acc.THA.AccGeneralVoucherEntry.JVprintCheck', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function JVprintStatic($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.THA.AccGeneralVoucherEntry.JVprintStatic', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function JVprintDynamic($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.THA.AccGeneralVoucherEntry.JVprintDynamic', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function ChkADJ($ADJFLAG) {
        $Param = array('ADJFLAG' => $ADJFLAG);
        return $this->GetReques($Param,  $this->APPCODE, 'ChkADJ');
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.THA.AccGeneralVoucherEntry.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
