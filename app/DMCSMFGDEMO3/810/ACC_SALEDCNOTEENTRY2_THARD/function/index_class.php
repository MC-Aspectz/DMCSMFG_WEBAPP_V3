<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccSaleDCNoteEntryRD extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_SALEDCNOTEENTRY2_THARD';
    }

//   AFTER RUN(DCLN2)
    public function getDC($DCNO) {
        try {
            $Param = array('DCNO' => $DCNO);
            $cmd = GetRequestData($Param, 'acc.THA.AccSaleDCNoteEntry2.getDC', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    // CLEAR AFTER RUN(DCLN2)
    public function getDC1($DCNO) {
        try {
            $Param = array('DCNO' => $DCNO);
            $cmd = GetRequestData($Param, 'acc.THA.AccSaleDCNoteEntry2RD.getDC', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    //DCLN2 AFTER RUN(DCMSG2) RUN(M1)
    public function getDC2($DCNO, $SALETRANNO, $DCTYP, $CHANGETYP) {
        try {
            $Param = array('DCNO' => $DCNO, 'SALETRANNO' => $SALETRANNO, 'DCTYP' => $DCTYP, 'CHANGETYP' => $CHANGETYP);
            $cmd = GetRequestData($Param, 'acc.THA.AccSaleDCNoteEntry2RD.getDC2', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getDCLn($DCNO, $SALETRANNO, $DCTYP, $CHANGETYP) {
        try {
            $Param = array('DCNO' => $DCNO, 'SALETRANNO' => $SALETRANNO, 'DCTYP' => $DCTYP, 'CHANGETYP' => $CHANGETYP);
            $cmd = GetRequestData($Param, 'acc.THA.AccSaleDCNoteEntry2RD.getDCLn', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    // AFTER RUN(DCMSG)
    public function getST($SALETRANNO) {
        try {
            $Param = array('SALETRANNO' => $SALETRANNO);
            $cmd = GetRequestData($Param, 'acc.THA.AccSaleDCNoteEntry2RD.getST', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    // AFTER RUN(S1)
    public function getST2($SALETRANNO) {
        try {
            $Param = array('SALETRANNO' => $SALETRANNO);
            $cmd = GetRequestData($Param, 'acc.THA.AccSaleDCNoteEntry2RD.getST2', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getSTLn($SALETRANNO, $DCTYP, $CHANGETYP) {
        try {
            $Param = array('SALETRANNO' => $SALETRANNO, 'DCTYP' => $DCTYP, 'CHANGETYP' => $CHANGETYP);
            $cmd = GetRequestData($Param, 'acc.THA.AccSaleDCNoteEntry2RD.getSTLn', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getStaff($STAFFCD) {
        try {
            $Param = array('STAFFCD' => $STAFFCD);
            $cmd = GetRequestData($Param, 'acc.AccSaleDCNoteEntry2.getStaff', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getAmt($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.THA.AccSaleDCNoteEntry2.getAmt', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function calculate($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.THA.AccSaleDCNoteEntry2RD.calculate', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getSum($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.THA.AccSaleDCNoteEntry2RD.getSum', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function commit($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.THA.AccSaleDCNoteEntry2RD.commit', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    // DCMESSAGE3 COMMIT2
    public function copy_txt($SALEDIVCON) {
        $Param = array('SALEDIVCON' => $SALEDIVCON);
        return $this->GetReques($Param,  $this->APPCODE, 'copy_txt');
    }

    // COMMIT3
    public function checkb4commit($QUOTEAMOUNT) {
        $Param = array('QUOTEAMOUNT' => $QUOTEAMOUNT);
        return $this->GetReques($Param,  $this->APPCODE, 'checkb4commit');
    }

    public function cancel($DCNO, $DCSVNO) {
        try {
            $Param = array('DCNO' => $DCNO, 'DCSVNO' => $DCSVNO);
            $cmd = GetRequestData($Param, 'acc.THA.AccSaleDCNoteEntry2RD.cancel', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
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

    // DCMSG DCMSG2 AFTER RUN(S1)
    public function DCMESSAGECMB($DCTYP) {
        $Param = array('DCTYP' => $DCTYP);
        return $this->GetReques($Param,  $this->APPCODE, 'DCMESSAGECMB');
    }

    // AAA BBB AFTER RUN(S1) RUN(STLN)
    public function MESSAGECMB($CHANGETYP) {
        $Param = array('CHANGETYP' => $CHANGETYP);
        return $this->GetReques($Param,  $this->APPCODE, 'MESSAGECMB');
    }

    public function NoteprintCheck($DCNO, $REPRINTREASON) {
        $Param = array('DCNO' => $DCNO, 'REPRINTREASON' => $REPRINTREASON);
        return $this->GetReques($Param, $this->APPCODE, 'NoteprintCheck');
    }

    public function NoteprintStatic($Param) {
        return $this->GetReques($Param, $this->APPCODE, 'NoteprintStatic');
    }

    public function NoteprintDaynamic($Param) {
        return $this->GetRequesAll($Param, $this->APPCODE, 'NoteprintDaynamic');
    }

    public function VoucherprintCheck($DCNO, $REPRINTREASON) {
        $Param = array('DCNO' => $DCNO, 'REPRINTREASON' => $REPRINTREASON);
        return $this->GetReques($Param, $this->APPCODE, 'VoucherprintCheck');
    }

    public function VoucherprintStatic($Param) {
        return $this->GetReques($Param, $this->APPCODE, 'VoucherprintStatic');
    }

    public function VoucherprintDaynamic($Param) {
        return $this->GetRequesAll($Param, $this->APPCODE, 'VoucherprintDaynamic');
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
