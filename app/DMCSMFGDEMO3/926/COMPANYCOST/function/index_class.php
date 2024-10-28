<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class COMPANYCOST extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'COMPANYCOST';
    }

    // gen.CompanyCost.load
    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'gen.CompanyCost.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    // gen.CompanyCost.upd COST_VALUE_01,COST_VALUE_02,COST_VALUE_03,COST_VALUE_04,COST_VALUE_05,
    //COST_VALUE_06,COST_VALUE_07,COST_VALUE_08,COST_VALUE_09,COST_VALUE_10,
    //COST_VALUE_11,COST_VALUE_12,COST_VALUE_13,COST_VALUE_14,COST_VALUE_15,
    //COST_VALUE_16,COST_VALUE_17,COST_VALUE_18,COST_VALUE_19,COST_VALUE_20,
    //COST_METHOD,SUBCONTRACT_COST
    public function upd($Param) {
        $cmd = GetRequestData($Param, 'gen.CompanyCost.upd', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

}
?>