<?php
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class InqShipTransaction02 {

    public function __construct() {
        $this->APPCODE = 'INQ_SHIP_TRANSACTION_02';
    }

    public function getCm($CUSTOMERCD) {
        try {
            $Param = array('CUSTOMERCD' => $CUSTOMERCD);
            $cmd = GetRequestData($Param, 'search.SearchTransaction.getCm', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function InqShipTran02($Param) {
        try {
            $cmd = GetRequestData($Param, 'search.SearchTransaction.InqShipTran02', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
?>