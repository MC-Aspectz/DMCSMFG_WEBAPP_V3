<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccReceiveVoucher3THA extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_RECEIVEVOUCHER3_THA';
    }

    public function getRvV3($RVNO) {
        try {
            $Param = array('RVNO' => $RVNO);
            $cmd = GetRequestData($Param, 'acc.THA.AccReceiveEntry.getRvV3', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getCustomer($CUSTOMERCD) {
        try {
            $Param = array('CUSTOMERCD' => $CUSTOMERCD);
            $cmd = GetRequestData($Param, 'acc.THA.AccReceiveEntry.getCustomer', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getCurrency($CUSCURCD) {
        try {
            $Param = array('CUSCURCD' => $CUSCURCD);
            $cmd = GetRequestData($Param, 'acc.THA.AccReceiveEntry.getCurrency', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getDiv($DIVISIONCD) {
        try {
            $Param = array('DIVISIONCD' => $DIVISIONCD);
            $cmd = GetRequestData($Param, 'acc.THA.AccReceiveEntry.getDiv', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getStaff($STAFFCD) {
        try {
            $Param = array('STAFFCD' => $STAFFCD);
            $cmd = GetRequestData($Param, 'acc.THA.AccReceiveEntry.getStaff', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getAcc($ACCCD, $DCTYP) {
        try {
            $Param = array('ACCCD' => $ACCCD, 'DCTYP' => $DCTYP);
            $cmd = GetRequestData($Param, 'acc.THA.AccReceiveEntry.getAcc', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function searchV3($RVNO, $RVSVNO, $CUSTOMERCD, $CUSCURCD, $DIVISIONCD) {
        try {
            $Param = array('RVNO' => $RVNO, 'RVSVNO' => $RVSVNO, 'CUSTOMERCD' => $CUSTOMERCD, 'CUSCURCD' => $CUSCURCD, 'DIVISIONCD' => $DIVISIONCD);
            $cmd = GetRequestData($Param, 'acc.THA.AccReceiveEntry.searchV3', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function searchJournalV3($RVNO, $RVSVNO) {
        try {
            $Param = array('RVNO' => $RVNO, 'RVSVNO' => $RVSVNO);
            $cmd = GetRequestData($Param, 'acc.THA.AccReceiveEntry.searchJournalV3', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function setDCTypV2($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.THA.AccReceiveEntry.setDCTypV2', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function setJournal($CUSTOMERCD, $CUSCURAMTTYP, $CUSCURCD, $COMCURCD, $DVWSALE) {
        try {
            $Param = array('CUSTOMERCD' => $CUSTOMERCD, 'CUSCURAMTTYP' => $CUSCURAMTTYP, 'CUSCURCD' => $CUSCURCD, 'COMCURCD' => $COMCURCD, 'DVWSALE' => $DVWSALE);
            $cmd = GetRequestData($Param, 'acc.THA.AccReceiveEntry.setJournal', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function Get_PrintCount($RVNO) {
        $Param = array('RVNO' => $RVNO);
        return $this->GetReques($Param,  $this->APPCODE, 'Get_PrintCount');
    }

    public function setSelReceived($CUSCURAMTTYP, $RECEIVEDV_SEL, $CALCBASE_OSTDAMT, $CALCBASE_VAT, $CALCBASE_WHT, $CALCBASE_OSTDTTLAMT) {
        try {
            $Param = array( 'CUSCURAMTTYP' => $CUSCURAMTTYP, 'RECEIVEDV_SEL' => $RECEIVEDV_SEL, 'CALCBASE_OSTDAMT' => $CALCBASE_OSTDAMT, 
                            'CALCBASE_VAT' => $CALCBASE_VAT, 'CALCBASE_WHT' => $CALCBASE_WHT, 'CALCBASE_OSTDTTLAMT' => $CALCBASE_OSTDTTLAMT);
            $cmd = GetRequestData($Param, 'acc.THA.AccReceiveEntry.setSelReceived', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function setCalcReceived($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.THA.AccReceiveEntry.setCalcReceived', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function checkV3($TTLRECAMT, $TTL_AMTC1, $TTL_AMTC2, $DATA) {
        try {
            $Param = array('TTLRECAMT' => $TTLRECAMT, 'TTL_AMTC1' => $TTL_AMTC1, 'TTL_AMTC2' => $TTL_AMTC2, 'DVW2' => '', 'DATA' => $DATA);
            $cmd = GetRequestData($Param, 'acc.THA.AccReceiveEntry.checkV3', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function commitV3($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.THA.AccReceiveEntry.commitV3', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function cancel($RVNO, $RVSVNO) {
        try {
            $Param = array('RVNO' => $RVNO, 'RVSVNO' => $RVSVNO);
            $cmd = GetRequestData($Param, 'acc.THA.AccReceiveEntry.cancel', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function RCprintCheck1($RVNO, $REPRINTREASON) {
        $Param = array('RVNO' => $RVNO, 'REPRINTREASON' => $REPRINTREASON);
        return $this->GetReques($Param,  $this->APPCODE, 'RCprintCheck1');
    }

    public function RCprintStatic($Param) {
        return $this->GetReques($Param,  $this->APPCODE, 'RCprintStatic');
    }

    public function RCprintDynamic($Param) {
        return $this->GetRequesAll($Param,  $this->APPCODE, 'RCprintDynamic');
    }

    public function IVPrintCheck($RVNO, $REPRINTREASON) {
        $Param = array('RVNO' => $RVNO, 'REPRINTREASON' => $REPRINTREASON);
        return $this->GetReques($Param,  $this->APPCODE, 'IVPrintCheck');
    }

    public function IVprintStatic($Param) {
        return $this->GetReques($Param,  $this->APPCODE, 'IVprintStatic');
    }

    public function IVprintDynamic($Param) {
        return $this->GetRequesAll($Param,  $this->APPCODE, 'IVprintDynamic');
    }

    public function IVprintDynamic2($Param) {
        return $this->GetRequesAll($Param,  $this->APPCODE, 'IVprintDynamic2');
    }

    public function RVprintCheck($RVNO, $REPRINTREASON) {
        $Param = array('RVNO' => $RVNO, 'REPRINTREASON' => $REPRINTREASON);
        return $this->GetReques($Param,  $this->APPCODE, 'RVprintCheck');
    }

    public function RVprintStatic($Param) {
        return $this->GetReques($Param,  $this->APPCODE, 'RVprintStatic');
    }

    public function RVprintDynamic($Param) {
        return $this->GetRequesAll($Param,  $this->APPCODE, 'RVprintDynamic');
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.THA.AccReceiveEntry.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
