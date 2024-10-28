<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class NewShipRequestEntry extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'NEWSHIPREQUESTENTRY';
    }

    public function getDiv($DIVISTIONCD) {
        try {
            $Param = array('DIVISTIONCD' => $DIVISTIONCD);
            $cmd = GetRequestData($Param, 'ship.BatchShipRequestEntry.getDiv', $this->APPCODE, '');
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
 
    public function search($Param) {
        try {
            $cmd = GetRequestData($Param, 'ship.BatchShipRequestEntry.search', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function commit($Param) {
        try {
            $cmd = GetRequestData($Param, 'ship.BatchShipRequestEntry.commit', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
?>