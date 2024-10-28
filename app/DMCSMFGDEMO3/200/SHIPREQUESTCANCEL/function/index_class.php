<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class ShipRequestCancel extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'SHIPREQUESTCANCEL';
    }

    public function getSaleOrder($SALEORDERNUMBER_S, $SALEORDERLINE_S) {
        try {
            $Param = array('SALEORDERNUMBER_S' => $SALEORDERNUMBER_S, 'SALEORDERLINE_S' => $SALEORDERLINE_S);
            $cmd = GetRequestData($Param, 'ship.BatchShipRequestEntry.getSaleOrder', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getDiv($LC_CODE) {
        try {
            $Param = array('LC_CODE' => $LC_CODE);
            $cmd = GetRequestData($Param, 'ship.BatchShipRequestEntry.getStorage', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getCustomer($CUSTOMERCD) {
        try {
            $Param = array('CUSTOMERCD' => $CUSTOMERCD);
            $cmd = GetRequestData($Param, 'ship.BatchShipRequestEntry.getCustomer', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getCatalog($CATALOGCD) {
        try {
            $Param = array('CATALOGCD' => $CATALOGCD);
            $cmd = GetRequestData($Param, 'ship.BatchShipRequestEntry.getCatalog', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getLoc($LOCCD, $LOCTYP) {
        try {
            $Param = array('LOCCD' => $LOCCD, 'LOCTYP' => $LOCTYP);
            $cmd = GetRequestData($Param, 'ship.BatchShipRequestEntry.getLoc', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function searchImOh($ITEMCODE) {
        try {
            $Param = array('ITEMCODE' => $ITEMCODE);
            $cmd = GetRequestData($Param, 'ship.BatchShipRequestEntry.searchImOh', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function searchCancel($Param) {
        try {
            $cmd = GetRequestData($Param, 'ship.BatchShipRequestEntry.searchCancel', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function cancelAll($Param) {
        try {
            $cmd = GetRequestData($Param, 'ship.BatchShipRequestEntry.cancelAll', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
?>