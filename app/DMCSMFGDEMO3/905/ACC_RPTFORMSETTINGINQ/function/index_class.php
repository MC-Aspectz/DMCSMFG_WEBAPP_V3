<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccRPTFormSettingInq extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_RPTFORMSETTINGINQ';
    }

    public function getRptForm($RPTFORMTYP) {
        try {
            $Param = array('RPTFORMTYP' => $RPTFORMTYP);
            $cmd = GetRequestData($Param, 'acc.AccRptForm.getRptForm', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getRptFormDtl($RPTFORMTYP, $FORMROWNUM) {
        try {
            $Param = array('RPTFORMTYP' => $RPTFORMTYP, 'FORMROWNUM' => $FORMROWNUM);
            $cmd = GetRequestData($Param, 'acc.AccRptForm.getRptFormDtl', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    // public function Print($Param) {
    //     return $this->GetRequesAll($Param,  $this->APPCODE, 'Print');
    // }

    // public function load() {
    //     $Param = array();
    //     $cmd = GetRequestData($Param, 'acc.AccRptForm.Load', $this->APPCODE, '');
    //     $data = Execute($cmd, $errorMessage);
    //     return $data;
    // }
}
?>