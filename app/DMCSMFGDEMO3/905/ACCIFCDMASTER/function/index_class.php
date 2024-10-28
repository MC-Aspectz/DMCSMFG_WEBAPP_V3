<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccountIntMaster  {

    public function __construct() {
        $this->APPCODE = 'ACCIFCDMASTER';
    }

    public function search($ACCIFCD_S, $ACCIFNAMES) {
        $Param = array('ACCIFCDS' => $ACCIFCD_S, 'ACCIFNAMES' => $ACCIFNAMES);
        $cmd = GetRequestData($Param, 'acc.AccIfCdMaster.search', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getAccIfCd($ACCIFCD) {
        $Param = array('ACCIFCD' => $ACCIFCD);
        $cmd = GetRequestData($Param, 'acc.AccIfCdMaster.getAccIfCd', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function insAccifcd($Param) {
        $cmd = GetRequestData($Param, 'acc.AccIfCdMaster.insert', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function updAccifcd($Param) {
        $cmd = GetRequestData($Param, 'acc.AccIfCdMaster.update', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function delAccifcd($Param) {
        $cmd = GetRequestData($Param, 'acc.AccIfCdMaster.delete', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?>