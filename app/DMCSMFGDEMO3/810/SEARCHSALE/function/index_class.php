<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class SearchSale extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'SEARCHSALE';
    }

    public function getDataSale($Param) {
        return $this->GetRequesAll($Param,  $this->APPCODE, 'getDataSale');
    }

    //syslogic(CalVAT)
    public function CalVAT($DVSALE) {
        $Param = array("DVSALE" => $DVSALE);
        return $this->GetRequesAll($Param ,  $this->APPCODE, 'CalVAT');
    }

    //syslogic(getDataTmp)
    public function getDataTmp() {
        $param = array();
        return $this->GetRequesAll($param,  $this->APPCODE, 'getDataTmp');
    }
}
?>