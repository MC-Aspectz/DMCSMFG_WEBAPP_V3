<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class DNCNReport extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_DNCNREPORT2';
    }
    //acc.AccDCNoteReport.getDataPur D1,D2,DCTYP
    public function getDataPur($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.AccDCNoteReport.getDataPur', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    //acc.AccDCNoteReport.getDataPurCnt D1,D2,DCTYP
    public function getDataPurCnt($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.AccDCNoteReport.getDataPurCnt', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    //acc.AccDCNoteReport.printStaticPur
    public function printStaticPur($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.AccDCNoteReport.printStaticPur', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    //acc.AccDCNoteReport.printDynamicPur
    public function printDynamicPur($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.AccDCNoteReport.printDynamicPur', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
?>