<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccDailyReport extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACCDAILYREPORT';
    }

    public function search($DATE1, $DATE2) {
        try {
            $Param = array( "DATE1" => $DATE1, "DATE2" => $DATE2);
            $cmd = GetRequestData($Param, 'acc.THA.AccDailyJournalReport.search', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function printStatic($DATE1, $DATE2) {
        try {
            $Param = array( "DATE1" => $DATE1, "DATE2" => $DATE2);
            $cmd = GetRequestData($Param, 'acc.AccDailyJournalReport.printStatic', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function printDynamic($DATE1, $DATE2) {
        try {
            $Param = array( "DATE1" => $DATE1, "DATE2" => $DATE2);
            $cmd = GetRequestData($Param, 'acc.AccDailyJournalReport.printDynamic', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
?>