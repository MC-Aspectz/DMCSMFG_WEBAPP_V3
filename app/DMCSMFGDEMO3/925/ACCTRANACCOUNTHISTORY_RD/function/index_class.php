<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class LoginHisAccRd extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACCTRANACCOUNTHISTORY_RD';
    }

   

   
    public function SearchLoginHisACCRd($STARTDATE1,$STARTDATE2) {
        $Param = array("STARTDATE1" => $STARTDATE1,"STARTDATE2" => $STARTDATE2);
        $cmd = GetRequestData($Param, 'acc.THA.LoggingAccountHistoryView_RD.search', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?>