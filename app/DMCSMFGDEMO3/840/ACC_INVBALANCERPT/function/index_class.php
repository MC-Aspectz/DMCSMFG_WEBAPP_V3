<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccInvBalanceRpt extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_INVBALANCERPT';
    }

//mas.ItemMaster.get	ITEMCD
    public function get($ITEMCD) {
        $Param = array( "ITEMCD" => $ITEMCD);
        $cmd = GetRequestData($Param, 'mas.ItemMaster.get', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

//acc.THA.ACC_INVBALANCERPT.getInvBalance	DVPERIOD,YEAR,MONTH,ITEMCD,ITEMCD2
    public function getInvBalance($DVPERIOD, $YEAR, $MONTH, $ITEMCD, $ITEMCD2) {
        $Param = array( "DVPERIOD" => $DVPERIOD,
                        "YEAR" => $YEAR,
                        "MONTH" => $MONTH,
                        "ITEMCD" => $ITEMCD,
                        "ITEMCD2" => $ITEMCD2,);
        $cmd = GetRequestData($Param, 'acc.THA.ACC_INVBALANCERPT.getInvBalance', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

//syslogic(Set_RptDoc_EN)	RPTDOCEN
    public function Set_RptDoc_EN($RPTDOCEN) {
        $Param = array( "RPTDOCEN" => $RPTDOCEN,);
        return $this->GetReques($Param, $this->APPCODE, 'Set_RptDoc_EN');
    }

//syslogic(Set_RptDoc_TH)	RPTDOCTH
    public function Set_RptDoc_TH($RPTDOCTH) {
    $Param = array( "RPTDOCTH" => $RPTDOCTH,);
    return $this->GetReques($Param, $this->APPCODE, 'Set_RptDoc_TH');
}

// Syslogic(load)
    public function load() {
        $Param = array();
        return $this->GetReques($Param, $this->APPCODE, 'load');
    }


}
?>