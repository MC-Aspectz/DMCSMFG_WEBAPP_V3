<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class ACCBOM extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACCBOM';
    }

    public function checkGroup($ACCGROUPTYP) {
        $Param = array('ACCGROUPTYP' => $ACCGROUPTYP);
        $cmd = GetRequestData($Param, 'mas.AccountTreeEntry.checkGroup', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function searchC($DATA) {
        $Param = array('DATA' => $DATA);
        $cmd = GetRequestData($Param, 'mas.AccountTreeEntry.searchC', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function searchG($ACCGROUPTYP) {
        $Param = array('ACCGROUPTYP' => $ACCGROUPTYP);
        $cmd = GetRequestData($Param, 'mas.AccountTreeEntry.searchG', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function insert($ACCOUNTCD, $DATA) {
        $Param = array('ACCOUNTCD' => $ACCOUNTCD, 'DATA' => $DATA);
        $cmd = GetRequestData($Param, 'mas.AccountTreeEntry.insert', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function update($ACCOUNTCDID, $ACCOUNTCD, $DATA) {
        $Param = array('ACCOUNTCDID' => $ACCOUNTCDID, 'ACCOUNTCD' => $ACCOUNTCD, 'DATA' => $DATA);
        $cmd = GetRequestData($Param, 'mas.AccountTreeEntry.update', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function delete($ACCOUNTCDID, $ACCOUNTCD, $DATA) {
        $Param = array('ACCOUNTCDID' => $ACCOUNTCDID, 'ACCOUNTCD' => $ACCOUNTCD, 'DATA' => $DATA);
        $cmd = GetRequestData($Param, 'mas.AccountTreeEntry.delete', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getAccCCd($ACCOUNTCDID, $ACCOUNTCD, $DATA) {
        $Param = array('ACCOUNTCDID' => $ACCOUNTCDID, 'ACCOUNTCD' => $ACCOUNTCD, 'DATA' => $DATA);
        $cmd = GetRequestData($Param, 'mas.AccountTreeEntry.getAccCCd', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?>