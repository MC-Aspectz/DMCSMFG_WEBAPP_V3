<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class NewShipEntryMFG extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'NEWSHIPENTRY_MFG';
    }

    public function getCustomer($CUSTOMERCD_S) {
        try {
            $Param = array('CUSTOMERCD_S' => $CUSTOMERCD_S);
            $cmd = GetRequestData($Param, 'ship.BatchShipEntry_MFG.getCustomer', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getCatalog($CATALOGCD) {
        try {
            $Param = array('CATALOGCD' => $CATALOGCD);
            $cmd = GetRequestData($Param, 'ship.BatchShipEntry_MFG.getCatalog', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getSale($SALEORDERNUMBER_S) {
        try {
            $Param = array('SALEORDERNUMBER_S' => $SALEORDERNUMBER_S);
            $cmd = GetRequestData($Param, 'ship.BatchShipEntry_MFG.getSale', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function search($Param) {
        try {
            $cmd = GetRequestData($Param, 'ship.BatchShipEntry_MFG.search', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
  
    public function commitAll($Param) {
        try {
            $cmd = GetRequestData($Param, 'ship.BatchShipEntry_MFG.commitAll', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
?>