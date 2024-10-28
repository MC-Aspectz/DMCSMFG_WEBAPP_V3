<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class ClearanceMonthInq extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'CLEARANCEMONTHINQ';
    }
//search.SearchTransaction.getDiv	DIVISIONCD
    public function getDiv($DIVISIONCD) {
        $Param = array( "DIVISIONCD" => $DIVISIONCD);
        $cmd = GetRequestData($Param, 'search.SearchTransaction.getDiv', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

//search.SearchTransaction.getIm	ITEMCD
    public function getIm($ITEMCD) {
        $Param = array( "ITEMCD" => $ITEMCD);
        $cmd = GetRequestData($Param, 'search.SearchTransaction.getIm', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

//inv.ClearanceMonthInq.search	YEAR,MONTH,CLEARANCE,ITEMTYPE,DIVISIONCD,ITEMCD,ADJUSTFLG,ALLITEM,DISPFLOATSCALE
    public function search($YEAR,$MONTH,$CLEARANCE,$ITEMTYPE,$DIVISIONCD,$ITEMCD,$ADJUSTFLG,$ALLITEM,$DISPFLOATSCALE) {
        $Param = array( "YEAR" => $YEAR,
                        "MONTH" => $MONTH,
                        "CLEARANCE" => $CLEARANCE,
                        "ITEMTYPE" => $ITEMTYPE,
                        "DIVISIONCD" => $DIVISIONCD,
                        "ITEMCD" => $ITEMCD,
                        "ADJUSTFLG" => $ADJUSTFLG,
                        "ALLITEM" => $ALLITEM,
                        "DISPFLOATSCALE" => $DISPFLOATSCALE,);
        $cmd = GetRequestData($Param, 'inv.ClearanceMonthInq.search', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

//inv.ClearanceMonthInq.load
    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'inv.ClearanceMonthInq.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
    return $data;
    }

}
?>