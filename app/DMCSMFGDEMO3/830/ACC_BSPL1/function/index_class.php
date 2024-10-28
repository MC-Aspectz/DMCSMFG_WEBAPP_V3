<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccBSPL1 extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'AccBSPL1';
    }

    public function printStatic($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.BSPLPrint.printStatic', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function printDynamic($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.BSPLPrint.printDynamic', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.BSPLPrint.Load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?>