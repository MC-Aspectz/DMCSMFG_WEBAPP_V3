<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class ClearanceOnhandUpdate extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'CLEARANCEONHANDUPDATE';
    }

    public function getLoc($LOCTYP, $LOCCD) {
        try {
            $Param = array('LOCTYP' => $LOCTYP, 'LOCCD' => $LOCCD);
            $cmd = GetRequestData($Param, 'inv.ClearanceOnHandUpdate.getLoc', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getDate($LOCTYP, $LOCCD) {
        try {
            $Param = array('LOCTYP' => $LOCTYP, 'LOCCD' => $LOCCD);
            $cmd = GetRequestData($Param, 'inv.ClearanceOnHandUpdate.getDate', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function search($LOCTYP, $LOCCD) {
        try {
            $Param = array('LOCTYP' => $LOCTYP, 'LOCCD' => $LOCCD);
            $cmd = GetRequestData($Param, 'inv.ClearanceOnHandUpdate.search', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function commit($Param) {
        try {
            $cmd = GetRequestData($Param, 'inv.ClearanceOnHandUpdate.commit', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function load() {
        try {
            $Param = array();
            $cmd = GetRequestData($Param, 'inv.ClearanceMonthUpdate.load', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
?>