<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class ShipmentEntry extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'SHIPMENTENTRY';
    }

    public function getShipTran($SHIPTRANORDERNO, $SHIPTRANORDERLN) {
        try {
            $Param = array('SHIPTRANORDERNO' => $SHIPTRANORDERNO, 'SHIPTRANORDERLN' => $SHIPTRANORDERLN);
            $cmd = GetRequestData($Param, 'ship.ShipEntryModify.getShipTran', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getStaff($STAFFCD) {
        try {
            $Param = array('STAFFCD' => $STAFFCD);
            $cmd = GetRequestData($Param, 'ship.ShipEntryModify.getStaff', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getLoc($LOCCD, $LOCTYP) {
        try {
            $Param = array('LOCCD' => $LOCCD, 'LOCTYP' => $LOCTYP);
            $cmd = GetRequestData($Param, 'ship.ShipEntryModify.getLoc', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function update($Param) {
        try {
            $cmd = GetRequestData($Param, 'ship.ShipEntryModify.update', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function delShipOd($Param) {
        try {
            $cmd = GetRequestData($Param, 'ship.ShipEntryModify.delShipOd', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
?>