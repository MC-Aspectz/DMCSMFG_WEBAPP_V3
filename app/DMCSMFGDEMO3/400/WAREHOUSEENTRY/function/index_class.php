<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class WarehouseEntry extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'WAREHOUSEENTRY';
    }

    public function getPro($PROORDERNO) {
        $Param = array( 'PROORDERNO' => $PROORDERNO,);
        $cmd = GetRequestData($Param, 'pro.WarehouseEntry.getPro', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getProTran($PROORDERNO, $PROTRANORDERNO) {
        $Param = array( 'PROORDERNO' => $PROORDERNO, 'PROTRANORDERNO' => $PROTRANORDERNO,);
        $cmd = GetRequestData($Param, 'pro.WarehouseEntry.getProTran', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function searchBad($PROORDERNO, $PROTRANORDERNO) {
        $Param = array( 'PROORDERNO' => $PROORDERNO, 'PROTRANORDERNO' => $PROTRANORDERNO,);
        $cmd = GetRequestData($Param, 'pro.WarehouseEntry.searchBad', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getStatus($PROQTY, $PROCOMPQTY, $PROTRANQTY, $BFPROTRANQTY) {
        $Param = array( 'PROQTY' => $PROQTY,
                        'PROCOMPQTY' => $PROCOMPQTY,
                        'PROTRANQTY' => $PROTRANQTY,
                        'BFPROTRANQTY' => $BFPROTRANQTY,);
        $cmd = GetRequestData($Param, 'pro.WarehouseEntry.getStatus', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function commit($Param) {
        $cmd = GetRequestData($Param, 'pro.WarehouseEntry.commit', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function commitBad($Param) {
        $cmd = GetRequestData($Param, 'pro.WarehouseEntry.commitBad', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function delete($Param) {
        $cmd = GetRequestData($Param, 'pro.WarehouseEntry.delete', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?>