<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class MANUFACTURINGPLAN extends Syslogic{

    public function __construct() {
        $this->APPCODE = 'MANUFACTURINGPLAN';
    }
   
    public function commitAll($Param) {
        $cmd = GetRequestData($Param, 'plan.ManufacturingPlan.commitAll', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function search($ITEMCODE) {
        $Param = array( "ITEMCODE" => $ITEMCODE);
        $cmd = GetRequestData($Param, 'plan.ManufacturingPlan.search', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getItem($ITEMCODE) {
        $Param = array( "ITEMCODE" => $ITEMCODE);
        $cmd = GetRequestData($Param, 'plan.ManufacturingPlan.getItem', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?> 
