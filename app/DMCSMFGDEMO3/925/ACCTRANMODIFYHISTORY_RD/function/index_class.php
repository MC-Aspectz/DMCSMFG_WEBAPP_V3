<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class LoginHisRd extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACCTRANMODIFYHISTORY_RD';
    }

   
    public function LoginHisRd($STARTDATE1,$STARTDATE2,$STAFFCDS,$PRGCDS) {
        $Param = array("STARTDATE1" => $STARTDATE1,"STARTDATE2" => $STARTDATE2,"STAFFCDS" => $STAFFCDS,"PRGCDS" => $PRGCDS);
        $cmd = GetRequestData($Param, 'acc.THA.LoggingHistoryView_RD.search2', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    
    public function SearchLoginHisRd($STARTDATE1,$STARTDATE2,$STAFFCDS,$PRGCDS) {
        $Param = array("STARTDATE1" => $STARTDATE1,"STARTDATE2" => $STARTDATE2,"STAFFCDS" => $STAFFCDS,"PRGCDS" => $PRGCDS);
        $cmd = GetRequestData($Param, 'acc.THA.LoggingHistoryView_RD.search2', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?>