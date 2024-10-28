<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class ItemCostCSV {

    public function __construct() {
        $this->APPCODE = 'ITEMCOSTCSV';
    }

    public function getItem($ITEMCODE) {
        try {
            $Param = array('ITEMCODE' => $ITEMCODE);
            $cmd = GetRequestData($Param, 'cost.ItemCostCSV.getItem', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function searchCost($Param) {
        try {
            $cmd = GetRequestData($Param, 'cost.ItemCostCSV.searchCost', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
// DVWCOST,ITEMCODE,COSTSC,COMBINATION,BMVERSION
    public function printDynamic($Param) {
        try {
            $cmd = GetRequestData($Param, 'cost.ItemCostCSV.printDynamic', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function printStatic($Param) {
        try {
            $cmd = GetRequestData($Param, 'cost.ItemCostCSV.printStatic', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
?> 