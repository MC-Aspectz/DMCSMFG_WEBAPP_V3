<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccMonthReportAll extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACCMONTHREPORT_ALL';
    }

    public function getInfo($ACCY, $ACCCD, $P1, $P2, $ACCCD1, $ACCCD2) {
        try {
            $Param = array('ACCY' => $ACCY, 'ACCCD' => $ACCCD, 'P1' => $P1, 'P2' => $P2, 'ACCCD1' => $ACCCD1, 'ACCCD2' => $ACCCD2);
            $cmd = GetRequestData($Param, 'acc.AccGeneralLedgerPrint.getInfo', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function GetGLInquiry($ACCY, $ACCCD, $P1, $P2, $ACCCD1, $ACCCD2) {
        $Param = array('ACCY' => $ACCY, 'ACCCD' => $ACCCD, 'P1' => $P1, 'P2' => $P2, 'ACCCD1' => $ACCCD1, 'ACCCD2' => $ACCCD2);
        return $this->GetRequesAll($Param,  $this->APPCODE, 'GetGLInquiry');
    }

    public function UpTmpGLInquiry($TMPDVW) {
        $Param = array("TMPDVW" => $TMPDVW);
        return $this->GetReques($Param,  $this->APPCODE, 'UpTmpGLInquiry');
    }

    public function GetGLBegining($ACCY, $ACCCD, $P1, $P2, $ACCCD1, $ACCCD2) {
        $Param = array('ACCY' => $ACCY, 'ACCCD' => $ACCCD, 'P1' => $P1, 'P2' => $P2, 'ACCCD1' => $ACCCD1, 'ACCCD2' => $ACCCD2);
        return $this->GetRequesAll($Param,  $this->APPCODE, 'GetGLBegining');
    }

    public function UpTmpGLBegining($TMPDVW) {
        $Param = array("TMPDVW" => $TMPDVW);
        return $this->GetReques($Param,  $this->APPCODE, 'UpTmpGLBegining');
    }

    public function CalBalGLInquiry($TMPDVW) {
        $Param = array("TMPDVW" => $TMPDVW);
        return $this->GetReques($Param,  $this->APPCODE, 'CalBalGLInquiry');
    }

    public function GetTmpGLInquiry() {
        $Param = array();
        return $this->GetRequesAll($Param,  $this->APPCODE, 'GetTmpGLInquiry');
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.AccGeneralLedgerPrint.onLoad', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?>