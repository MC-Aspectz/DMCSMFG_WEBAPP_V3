<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class CalendarMaster {

    public function __construct() {
        $this->APPCODE = 'CALENDAR';
    }

    public function getStartDay($FROMDATE) {
        $Param = array('FROMDATE'  => $FROMDATE);
        $cmd = GetRequestData($Param, 'gen.Calendar.getStartDay', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
   
    public function changeChkDay($Param) {
        $cmd = GetRequestData($Param, 'gen.Calendar.changeChkDay', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function create($Param) {
        $cmd = GetRequestData($Param, 'gen.Calendar.create', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getCalScreen($Param) {
        $cmd = GetRequestData($Param, 'gen.Calendar.getCalScreen', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
  
    public function setHoliday($Param) {
        $cmd = GetRequestData($Param, 'gen.Calendar.setHoliday', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function clearScreen() {
        $Param = array();
        $cmd = GetRequestData($Param, 'gen.Calendar.clearScreen', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'gen.Calendar.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?> 