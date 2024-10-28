<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccInvTransRptAsDate extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_INVTRANSRPT';
    }

//mas.ItemMaster.get	ITEMCD
    public function get($ITEMCD) {
        $Param = array( "ITEMCD" => $ITEMCD);
        $cmd = GetRequestData($Param, 'mas.ItemMaster.get', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

//acc.THA.ACC_INVTRANSRPT_ASDATE.getInvTrans	DVPERIOD,RPTDATE1,RPTDATE2,ITEMCD,ITEMCD2
    public function getInvTrans($DVPERIOD, $RPTDATE1, $RPTDATE2, $ITEMCD, $ITEMCD2) {
        $Param = array( "DVPERIOD" => $DVPERIOD,
                        "RPTDATE1" => $RPTDATE1,
                        "RPTDATE2" => $RPTDATE2,
                        "ITEMCD" => $ITEMCD,
                        "ITEMCD2" => $ITEMCD2,);
        $cmd = GetRequestData($Param, 'acc.THA.ACC_INVTRANSRPT_ASDATE.getInvTrans', $this->APPCODE, '');
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

// syslogic(Print_Rpt) RPTDATE1,RPTDATE2,ITEMCD,ITEMCD2,RPTDOC
public function Print_Rpt($RPTDATE1,$RPTDATE2,$ITEMCD,$ITEMCD2,$RPTDOC) {
        $Param = array( "RPTDATE1" => $RPTDATE1,
                        "RPTDATE2" => $RPTDATE2,
                        "ITEMCD" => $ITEMCD,
                        "ITEMCD2" => $ITEMCD2,
                        "RPTDOC" => $RPTDOC,);
    return $this->GetReques($Param, $this->APPCODE, 'Print_Rpt');
}


// Syslogic(load)
    public function load() {
        $Param = array();
        return $this->GetRequesAll($Param, $this->APPCODE, 'load');
    }


}
?>