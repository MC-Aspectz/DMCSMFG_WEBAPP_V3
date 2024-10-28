<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AppHistory extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'APPHISTORYVIEW';
    }

    //SYSLANG,SYSAPPNAME,STARTDATE1,STARTDATE2,STAFFCDS,PRGCDS
    public function appPrView($STARTDATE1,$STARTDATE2,$STAFFCDS,$PRGCDS) {
        $Param = array("STARTDATE1" => $STARTDATE1,"STARTDATE2" => $STARTDATE2,"STAFFCDS" => $STAFFCDS,"PRGCDS" => $PRGCDS);
        $cmd = GetRequestData($Param, 'gen.ProgramRun.appPrView', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function SearchappPrView($STARTDATE1,$STARTDATE2,$STAFFCDS,$PRGCDS) {
        $Param = array("STARTDATE1" => $STARTDATE1,"STARTDATE2" => $STARTDATE2,"STAFFCDS" => $STAFFCDS,"PRGCDS" => $PRGCDS);
        $cmd = GetRequestData($Param, 'gen.ProgramRun.appPrView', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?>