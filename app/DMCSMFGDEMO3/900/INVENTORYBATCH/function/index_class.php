<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class InventoryBatch {

    public function __construct() {
        $this->APPCODE = 'INVENTORYBATCH';
    }

    public function Runinventorybatch($Param) {
        $cmd = GetRequestData($Param, 'mon.InventoryBatch.batch', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
       
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'mon.InventoryBatch.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

}
?> 
