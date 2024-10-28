<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccFifolistSub extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_FIFOLIST_SUB';
    }

//mas.ItemMaster.get	ITEMCD
    // public function get($ITEMCD) {
    //     $Param = array( "ITEMCD" => $ITEMCD);
    //     $cmd = GetRequestData($Param, 'mas.ItemMaster.get', $this->APPCODE, '');
    //     $data = Execute($cmd, $errorMessage);
    //     return $data;
    // }//java

//Syslogic(search)	ITEMCODES,YEAR,MONTH,YEAR2,MONTH2
    public function search( $ITEMCODES, $YEAR, $MONTH, $YEAR2, $MONTH2) {
        $Param = array( "ITEMCODES" => $ITEMCODES,
                        "YEAR" => $YEAR,
                        "MONTH" => $MONTH,
                        "YEAR2" => $YEAR2,
                        "MONTH2" => $MONTH2,
                        );
        return $this->GetReques($Param, $this->APPCODE, 'search');
    }//syslogic



}
?>