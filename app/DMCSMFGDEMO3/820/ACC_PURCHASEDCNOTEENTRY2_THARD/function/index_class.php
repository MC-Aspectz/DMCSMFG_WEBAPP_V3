<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccPurchaseDCNoteEntryRD extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_PURCHASEDCNOTEENTRY2_THARD';
    }

    public function getDC($DCNO) {
        try {
            $Param = array('DCNO' => $DCNO);
            $cmd = GetRequestData($Param, 'acc.THA.AccPurDCNoteEntry2RD.getDC', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getDC2($DCNO, $PVNO, $DCTYP, $CHANGETYP) {
        try {
            $Param = array('DCNO' => $DCNO, 'PVNO' => $PVNO, 'DCTYP' => $DCTYP, 'CHANGETYP' => $CHANGETYP);
            $cmd = GetRequestData($Param, 'acc.THA.AccPurDCNoteEntry2RD.getDC2', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getDCLn($DCNO, $PVNO, $DCTYP, $CHANGETYP) {
        try {
            $Param = array('DCNO' => $DCNO, 'PVNO' => $PVNO, 'DCTYP' => $DCTYP, 'CHANGETYP' => $CHANGETYP);
            $cmd = GetRequestData($Param, 'acc.THA.AccPurDCNoteEntry2RD.getDCLn', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data; 
        } catch (Exception $ex) {
            return $ex->getMessage();                
        }
    }

    public function getPV($PVNO) {
        try {
            $Param = array('PVNO' => $PVNO);
            $cmd = GetRequestData($Param, 'acc.THA.AccPurDCNoteEntry2RD.getPV', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getPV2($PVNO) {
        try {
            $Param = array('PVNO' => $PVNO);
            $cmd = GetRequestData($Param, 'acc.THA.AccPurDCNoteEntry2RD.getPV2', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getPVLn($PVNO, $DCTYP, $CHANGETYP) {
        try {
            $Param = array('PVNO' => $PVNO, 'DCTYP' => $DCTYP, 'CHANGETYP' => $CHANGETYP);
            $cmd = GetRequestData($Param, 'acc.THA.AccPurDCNoteEntry2RD.getPVLn', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function chkSupIssueDt($ADD12, $DCDATE) {
        try {
            $Param = array('ADD12' => $ADD12, 'DCDATE' => $DCDATE);
            $cmd = GetRequestData($Param, 'acc.THA.AccPurDCNoteEntry2.chkSupIssueDt', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getStaff($STAFFCD) {
        try {
            $Param = array('STAFFCD' => $STAFFCD);
            $cmd = GetRequestData($Param, 'acc.AccPurDCNoteEntry2.getStaff', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getAmt($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.THA.AccPurDCNoteEntry2RD.getAmt', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    public function commit($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.THA.AccPurDCNoteEntry2RD.commit', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function cancel($DCNO, $DCSVNO) {
        try {
            $Param = array('DCNO' => $DCNO, 'DCSVNO' => $DCSVNO);
            $cmd = GetRequestData($Param, 'acc.THA.AccPurDCNoteEntry2RD.cancel', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    // COMMIT2
    public function checkb4commit($QUOTEAMOUNT, $ADD12, $DCDATE) {
        $Param = array('QUOTEAMOUNT' => $QUOTEAMOUNT, 'ADD12' => $ADD12, 'DCDATE' => $DCDATE);
        return $this->GetReques($Param,  $this->APPCODE, 'checkb4commit');
    }

    // S1
    public function getSALEDIVCON($DCNO) {
        try {
            $Param = array('DCNO' => $DCNO);
            return $this->GetReques($Param, $this->APPCODE, 'getSALEDIVCON');
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function CRMSG2ADD11($CRMSG) {
        $Param = array('CRMSG' => $CRMSG);
        return $this->GetReques($Param,  $this->APPCODE, 'CRMSG2ADD11');
    }

    public function DRMSG2ADD11($DRMSG) {
        $Param = array('DRMSG' => $DRMSG);
        return $this->GetReques($Param,  $this->APPCODE, 'DRMSG2ADD11');
    }

    public function DCMESSAGECMB($DCTYP) {
        $Param = array('DCTYP' => $DCTYP);
        return $this->GetReques($Param,  'ACC_SALEDCNOTEENTRY2_THARD', 'DCMESSAGECMB');
    }

    public function MESSAGECMB($CHANGETYP) {
        $Param = array('CHANGETYP' => $CHANGETYP);
        return $this->GetReques($Param,  'ACC_SALEDCNOTEENTRY2_THARD', 'MESSAGECMB');
    }

    public function VoucherprintStatic($Param) {
        return $this->GetReques($Param, $this->APPCODE, 'VoucherprintStatic');
    }

    public function VoucherprintDaynamic($Param) {
        return $this->GetReques($Param, $this->APPCODE, 'VoucherprintDaynamic');
    }
    // M1
    public function commitAddData($DCNO, $SALEDIVCON) {
        $Param = array('DCNO' => $DCNO, 'SALEDIVCON' => $SALEDIVCON);
        return $this->GetReques($Param, $this->APPCODE, 'commitAddData');
    }

    public function ShowMsg1() {
        $Param = array();
        return $this->GetReques($Param, 'ACC_GENERALVO', 'ShowMsg1');
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleDCNoteEntry2RD.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
