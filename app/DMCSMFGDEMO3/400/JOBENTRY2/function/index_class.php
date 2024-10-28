<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class JobResultEntry2 {

    public function __construct() {
        $this->APPCODE = 'JOBENTRY2';
    }

    public function getProduction($PROORDERNO, $TIMESTAMP) {
        $Param = array('PROORDERNO' => $PROORDERNO, 'TIMESTAMP' => $TIMESTAMP);
        $cmd = GetRequestData($Param, 'pro.JobEntry2.getProduction', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getStaff($STAFFCD) {
        $Param = array('STAFFCD' => $STAFFCD);
        $cmd = GetRequestData($Param, 'pro.JobEntry2.getStaff', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getJobDetail($PROORDERNO, $PROPSSNO) {
        $Param = array('PROORDERNO' => $PROORDERNO, 'PROPSSNO' => $PROPSSNO);
        $cmd = GetRequestData($Param, 'pro.JobEntry2.getJobDetail', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getPlace($JOBPROPSSTYP, $LOCCD) {
        $Param = array('JOBPROPSSTYP' => $JOBPROPSSTYP, 'LOCCD' => $LOCCD);
        $cmd = GetRequestData($Param, 'pro.JobEntry2.getPlace', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function chkStatus($JOBPROCOMQTY, $PROCOMPQTY, $PROQTY) {
        $Param = array('JOBPROCOMQTY' => $JOBPROCOMQTY, 'PROCOMPQTY' => $PROCOMPQTY, 'PROQTY' => $PROQTY);
        $cmd = GetRequestData($Param, 'pro.JobEntry2.chkStatus', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getPlanHour($Param) {
        // $Param = array('JOBPROSTARTTM' => $JOBPROSTARTTM, 'JOBPROENDTM' => $JOBPROENDTM, 'JOBPROMEMBER' => $JOBPROMEMBER, 'WORKTIMECD' => $WORKTIMECD);
        $cmd = GetRequestData($Param, 'pro.JobEntry2.getPlanHour', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function commitAll($Param) {
        $cmd = GetRequestData($Param, 'pro.JobEntry2.commitAll', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function searchJob($PROORDERNO) {
        $Param = array('PROORDERNO' => $PROORDERNO);
        $cmd = GetRequestData($Param, 'pro.JobEntry2.searchJob', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function searchScrap($Param) {
        // PROORDERNO,PROPSSNO,TIMESTAMP,JOBPROORDERNO
        $cmd = GetRequestData($Param, 'pro.JobEntry2.searchScrap', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
    
    public function getSumScrap($Param) {
        // PROORDERNO,PROPSSNO,TIMESTAMP,JOBPROORDERNO
        $cmd = GetRequestData($Param, 'pro.JobEntry2.getSumScrap', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function updateTmpScrap($Param) {
        // TIMESTAMP,JOBPROORDERNO,PROORDERNO,PROPSSNO,PROSCRAPTYP,PROSCRAPQTY
        $cmd = GetRequestData($Param, 'pro.JobEntry2.updateTmpScrap', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }


    public function deleteTmpScrap($JOBPROORDERNO, $PROPSSNO, $TIMESTAMP) {
        $Param = array('JOBPROORDERNO' => $JOBPROORDERNO, 'PROPSSNO' => $PROPSSNO, 'TIMESTAMP' => $TIMESTAMP);
        $cmd = GetRequestData($Param, 'pro.JobEntry2.deleteTmpScrap', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }


    public function clearTmp($TIMESTAMP) {
        $Param = array('TIMESTAMP' => $TIMESTAMP);
        $cmd = GetRequestData($Param, 'pro.JobEntry2.clearTmp', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?> 
