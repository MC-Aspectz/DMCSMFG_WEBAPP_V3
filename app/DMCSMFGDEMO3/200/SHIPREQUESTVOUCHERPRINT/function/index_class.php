<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class ShipRequestVoucherPrint extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'SHIPREQUESTVOUCHERPRINT';
    }

    public function getStaff($STAFFCODE) {
        try {
            $Param = array('STAFFCODE' => $STAFFCODE);
            $cmd = GetRequestData($Param, 'ship.ShippingRequestEntry.getStaff', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getCatalog($CATALOGCODE) {
        try {
            $Param = array('CATALOGCODE' => $CATALOGCODE);
            $cmd = GetRequestData($Param, 'ship.ShippingRequestEntry.getCatalog', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function controlPrint($REP01) {
        try {
            $Param = array('REP01' => $REP01);
            $cmd = GetRequestData($Param, 'ship.ShippingRequestEntry.controlPrint', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function searchPrint($Param) {
        try {
            $cmd = GetRequestData($Param, 'ship.ShippingRequestEntry.searchPrint', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function print($Param) {
        try {
            $cmd = GetRequestData($Param, 'ship.ShippingRequestEntry.print', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function printStatic1($Param) {
        try {
            $cmd = GetRequestData($Param, 'ship.ShippingRequestEntry.printStatic1', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function printDynamic1($Param) {
        try {
            $cmd = GetRequestData($Param, 'ship.ShippingRequestEntry.printDynamic1', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function printStatic2($Param) {
        try {
            $cmd = GetRequestData($Param, 'ship.ShippingRequestEntry.printStatic2', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    public function printDynamic2($Param) {
        try {
            $cmd = GetRequestData($Param, 'ship.ShippingRequestEntry.printDynamic2', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
?>