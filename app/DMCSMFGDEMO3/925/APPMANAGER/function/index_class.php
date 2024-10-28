<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AppManager extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'APPMANAGER';
    }

    public function appView() {
        $Param = array();
        $cmd = GetRequestData($Param, 'gen.ProgramRun.appView', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function killRow($Param) {
        $cmd = GetRequestData($Param, 'gen.ProgramRun.killRow', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?>