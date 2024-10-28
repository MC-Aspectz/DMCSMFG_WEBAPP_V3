<?php
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class CSVsaleOrderPOSship {

    public function __construct() {
        $this->APPCODE = 'CSVSALEORDERPOSSHIP';
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

    public function getIm($ITEMCD) {
        try {
            $Param = array('ITEMCD' => $ITEMCD);
            $cmd = GetRequestData($Param, 'search.SearchTransaction.getIm', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function CsvSalePosShip($Param) {
        try {
            $cmd = GetRequestData($Param, 'search.SearchTransaction.CsvSalePosShip', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
?>