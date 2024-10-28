<?php
require_once(dirname(__FILE__, 5) . '/common/syslogic.php');
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class SearchAccifcd extends Syslogic {

    public $ACCIFCDS = '';
    public $ACCIFNAMES = '';

    public function __construct() {
        $this->APPCODE = 'SEARCHACCIFCD';
    }

    public function getAccifcd($ACCIFCDS, $ACCIFNAMES) {
        $Param = array("ACCIFCDS" => $ACCIFCDS,"ACCIFNAMES" => $ACCIFNAMES);
        $cmd = GetRequestData($Param, 'acc.AccIfCdMaster.searchGuide', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 
