<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class SearchPurchase extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'SEARCHPURCHASE';
    }

    public function getDataPurchase($Param) {
        return $this->GetRequesAll($Param,  $this->APPCODE, 'getDataPurchase');
    }

    //syslogic(CalVAT) DVPURC
    public function CalVAT($DVPURC) {
        $Param = array( 'DVPURC' => $DVPURC,);
        return $this->GetRequesAll($Param, $this->APPCODE, 'CalVAT');
    }

    // syslogic(getDataTmp)
    public function getDataTmp() {
        $Param = array();
        return $this->GetRequesAll($Param, $this->APPCODE, 'getDataTmp');
    }

}
?>