<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccFifolistMain extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_FIFOLIST_MAIN';
    }

//mas.ItemMaster.get	ITEMCD
    public function get($ITEMCD) {
        $Param = array( "ITEMCD" => $ITEMCD);
        $cmd = GetRequestData($Param, 'mas.ItemMaster.get', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

//Syslogic(search)	DVPERIOD,YEAR,MONTH,YEAR2,MONTH2,ITEMCD
    //ไม่มีDVPERIOD
    // public function search( $YEAR, $MONTH, $YEAR2, $MONTH2, $ITEMCD) {
    //     $Param = array( 
    //                     "YEAR" => $YEAR,
    //                     "MONTH" => $MONTH,
    //                     "YEAR2" => $YEAR2,
    //                     "MONTH2" => $MONTH2,
    //                     "ITEMCD" => $ITEMCD,);
    //     return $this->GetReques($Param, $this->APPCODE, 'search');
    // }
    //มีDVPERIOD
    public function search($DVPERIOD, $YEAR, $MONTH, $YEAR2, $MONTH2, $ITEMCD) {
        $Param = array( "DVPERIOD" => $DVPERIOD,
                        "YEAR" => $YEAR,
                        "MONTH" => $MONTH,
                        "YEAR2" => $YEAR2,
                        "MONTH2" => $MONTH2,
                        "ITEMCD" => $ITEMCD,);
        return $this->GetReques($Param, $this->APPCODE, 'search');
    }

//syslogic(search2)	YEAR,MONTH,YEAR2,MONTH2,ITEMCD
    public function search2($YEAR, $MONTH, $YEAR2, $MONTH2, $ITEMCD) {
    $Param = array( "YEAR" => $YEAR,
                    "MONTH" => $MONTH,
                    "YEAR2" => $YEAR2,
                    "MONTH2" => $MONTH2,
                    "ITEMCD" => $ITEMCD,);
    return $this->GetReques($Param, $this->APPCODE, 'search2');
}

//syslogic(search3) YEAR,MONTH,YEAR2,MONTH2,ITEMCD
    public function search3($YEAR, $MONTH, $YEAR2, $MONTH2, $ITEMCD) {
        $Param = array( "YEAR" => $YEAR,
                        "MONTH" => $MONTH,
                        "YEAR2" => $YEAR2,
                        "MONTH2" => $MONTH2,
                        "ITEMCD" => $ITEMCD,);
        return $this->GetReques($Param, $this->APPCODE, 'search3');
    }

// Syslogic(load)
    public function load() {
        $Param = array();
        return $this->GetReques($Param, $this->APPCODE, 'load');
    }


}
?>