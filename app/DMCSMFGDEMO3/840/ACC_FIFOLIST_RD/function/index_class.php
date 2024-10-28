<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccFifolistRd extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_FIFOLIST_RD';
    }

//mas.ItemMaster.get	ITEMCD
    public function get($ITEMCD) {
        $Param = array( "ITEMCD" => $ITEMCD);
        $cmd = GetRequestData($Param, 'mas.ItemMaster.get', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

//acc.THA.ACC_FIFOLIST_RD.getInvTrans	DVPERIOD,YEAR,MONTH,YEAR2,MONTH2,ITEMCD,ITEMCD2,ITEMTYP
    public function getInvTrans($DVPERIOD, $YEAR, $MONTH, $YEAR2, $MONTH2, $ITEMCD, $ITEMCD2, $ITEMTYP) {
        $Param = array( "DVPERIOD" => $DVPERIOD,
                        "YEAR" => $YEAR,
                        "MONTH" => $MONTH,
                        "YEAR2" => $YEAR2,
                        "MONTH2" => $MONTH2,
                        "ITEMCD" => $ITEMCD,
                        "ITEMCD2" => $ITEMCD2,
                        "ITEMTYP" => $ITEMTYP);
        $cmd = GetRequestData($Param, 'acc.THA.ACC_FIFOLIST_RD.getInvTrans', $this->APPCODE, '');
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