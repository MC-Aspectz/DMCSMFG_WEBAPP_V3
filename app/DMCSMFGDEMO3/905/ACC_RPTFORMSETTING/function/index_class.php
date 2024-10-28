<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccRPTFormSetting extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_RPTFORMSETTING';
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

    public function insRptFormDtl($RPTFORMTYP, $FORMROWNUM, $ACC_CD, $CALC_TYP) {
        try {
            $Param = array('RPTFORMTYP' => $RPTFORMTYP, 'FORMROWNUM' => $FORMROWNUM, 'ACC_CD' => $ACC_CD, 'CALC_TYP' => $CALC_TYP);
            $cmd = GetRequestData($Param, 'acc.AccRptForm.insRptFormDtl', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function updRptFormDtl($RPTFORMTYP, $FORMROWNUM, $ACC_CD, $CALC_TYP, $ACCSEQ) {
        try {
            $Param = array('RPTFORMTYP' => $RPTFORMTYP, 'FORMROWNUM' => $FORMROWNUM, 'ACC_CD' => $ACC_CD, 'CALC_TYP' => $CALC_TYP, 'ACCSEQ' => $ACCSEQ);
            $cmd = GetRequestData($Param, 'acc.AccRptForm.updRptFormDtl', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function delRptFormDtl($RPTFORMTYP, $FORMROWNUM, $ACC_CD, $CALC_TYP, $ACCSEQ) {
        try {
            $Param = array('RPTFORMTYP' => $RPTFORMTYP, 'FORMROWNUM' => $FORMROWNUM, 'ACC_CD' => $ACC_CD, 'CALC_TYP' => $CALC_TYP, 'ACCSEQ' => $ACCSEQ);
            $cmd = GetRequestData($Param, 'acc.AccRptForm.delRptFormDtl', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getAccount($ACC_CD) {
        try {
            $Param = array('ACC_CD' => $ACC_CD);
            $cmd = GetRequestData($Param, 'acc.AccRptForm.getAccount', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function insRptForm($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.AccRptForm.insRptForm', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function updRptForm($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.AccRptForm.updRptForm', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function delRptForm($RPTFORMTYP, $FORMROWNUM) {
        try {
            $Param = array('RPTFORMTYP' => $RPTFORMTYP, 'FORMROWNUM' => $FORMROWNUM);
            $cmd = GetRequestData($Param, 'acc.AccRptForm.delRptForm', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
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