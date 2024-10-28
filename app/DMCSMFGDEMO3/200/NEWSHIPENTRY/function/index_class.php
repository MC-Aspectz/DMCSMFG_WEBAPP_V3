<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class NewShipEntry extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'NEWSHIPENTRY';
    }

    public function getCustomer($CUSTOMERCD_S) {
        try {
            $Param = array('CUSTOMERCD_S' => $CUSTOMERCD_S);
            $cmd = GetRequestData($Param, 'ship.BatchShipEntry.getCustomer', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getCatalog($CATALOGCD) {
        try {
            $Param = array('CATALOGCD' => $CATALOGCD);
            $cmd = GetRequestData($Param, 'ship.BatchShipEntry.getCatalog', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getSale($SALEORDERNUMBER_S) {
        try {
            $Param = array('SALEORDERNUMBER_S' => $SALEORDERNUMBER_S);
            $cmd = GetRequestData($Param, 'ship.BatchShipEntry.getSale', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function search($Param) {
        try {
            $cmd = GetRequestData($Param, 'ship.BatchShipEntry.search', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
  
    public function commitAll($Param) {
        try {
            $cmd = GetRequestData($Param, 'ship.BatchShipEntry.commitAll', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
?>