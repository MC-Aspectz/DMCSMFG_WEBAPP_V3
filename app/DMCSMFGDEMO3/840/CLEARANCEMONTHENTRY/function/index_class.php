<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class ClearanceMonthEntry extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'CLEARANCEMONTHENTRY';
    }

    public function getItem($ITEMCODE, $CLEARANCE) {
        try {
            $Param = array('ITEMCODE' => $ITEMCODE, 'CLEARANCE' => $CLEARANCE);
            $cmd = GetRequestData($Param, 'inv.ClearanceMonthEntry.getItem', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getLoc($LOCTYP, $LOCCD) {
        try {
            $Param = array('LOCTYP' => $LOCTYP, 'LOCCD' => $LOCCD);
            $cmd = GetRequestData($Param, 'inv.ClearanceMonthEntry.getLoc', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function search($YEAR, $MONTH, $CLEARANCE) {
        try {
            $Param = array('YEAR' => $YEAR, 'MONTH' => $MONTH, 'CLEARANCE' => $CLEARANCE);
            $cmd = GetRequestData($Param, 'inv.ClearanceMonthEntry.search', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function checkDate($YEAR, $MONTH, $CLEARANCEDATE) {
        try {
            $Param = array('YEAR' => $YEAR, 'MONTH' => $MONTH, 'CLEARANCEDATE' => $CLEARANCEDATE);
            $cmd = GetRequestData($Param, 'inv.ClearanceMonthEntry.checkDate', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function commit($Param) {
        try {
            $cmd = GetRequestData($Param, 'inv.ClearanceMonthEntry.commit', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getLocSysLogic($LOCTYP, $LOCCD) {
        try {
            $Param = array('LOCTYP' => $LOCTYP, 'LOCCD' => $LOCCD);
            return $this->GetReques($Param, $this->APPCODE, 'getLoc');
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function load() {
        try {
            $Param = array();
            $cmd = GetRequestData($Param, 'inv.ClearanceMonthEntry.load', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
?>