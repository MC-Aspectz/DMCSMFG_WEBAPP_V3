<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class ShipingRequestEntry extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'SHIPPINGREQUESTENTRY';
    }

    public function getOrder($SALEORDERNO) {
        try {
            $Param = array('SALEORDERNO' => $SALEORDERNO);
            $cmd = GetRequestData($Param, 'ship.ShippingRequestEntry.getOrder', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function search($SALEORDERNO) {
        try {
            $Param = array('SALEORDERNO' => $SALEORDERNO);
            $cmd = GetRequestData($Param, 'ship.ShippingRequestEntry.search', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function chkQty($THISSHIPQTY, $ORDERBALANCE) {
        try {
            $Param = array('THISSHIPQTY' => $THISSHIPQTY, 'ORDERBALANCE' => $ORDERBALANCE);
            $cmd = GetRequestData($Param, 'ship.ShippingRequestEntry.chkQty', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getLoc($LOCCD, $LOCTYP) {
        try {
            $Param = array('LOCCD' => $LOCCD, 'LOCTYP' => $LOCTYP);
            $cmd = GetRequestData($Param, 'ship.ShippingRequestEntry.getLoc', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function commitAll($Param) {
        try {
            $cmd = GetRequestData($Param, 'ship.ShippingRequestEntry.commitAll', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
?>