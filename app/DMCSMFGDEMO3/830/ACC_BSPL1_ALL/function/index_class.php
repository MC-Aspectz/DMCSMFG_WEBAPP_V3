<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccBSPL1All extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_BSPL1_ALL';
    }

    public function printStatic($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.BSPLPrint_ALL.printStatic', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function printDynamic($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.BSPLPrint_ALL.printDynamic', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.BSPLPrint_ALL.Load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?>