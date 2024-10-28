<?php
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class YearEndProcess {

    public function __construct() {
        $this->APPCODE = 'ACCTRANUPDATE';
    }

    public function update($Param) {
        $cmd = GetRequestData($Param, 'acc.AccTranUpdate.update', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
       
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.AccTranUpdate.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?> 
