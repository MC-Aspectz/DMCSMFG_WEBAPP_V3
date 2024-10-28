<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class DNCNReport extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_DNCNREPORT';
    }
    //acc.AccDCNoteReport.getDataSale (D1,D2,DCTYP)
    public function getDataSale($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.AccDCNoteReport.getDataSale', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    //acc.AccDCNoteReport.getDataSaleCnt (D1,D2,DCTYP)
    public function getDataSaleCnt($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.AccDCNoteReport.getDataSaleCnt', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    //acc.AccDCNoteReport.printStaticSale,acc.AccDCNoteReport.printDynamicSale
    public function printStaticSale($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.AccDCNoteReport.printStaticSale', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function printDynamicSale($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.AccDCNoteReport.printDynamicSale', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
?>