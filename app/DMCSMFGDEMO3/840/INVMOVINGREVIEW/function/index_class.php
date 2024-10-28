<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class InvReview extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'INVMOVINGREVIEW';
    }
//inv.InvReview.getItem	ITEMCODE
    public function getItem($ITEMCODE) {
        $Param = array( "ITEMCODE" => $ITEMCODE);
        $cmd = GetRequestData($Param, 'inv.InvReview.getItem', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

//inv.InvReview.reviewMV	ITEMCODE,FROMDATE,TODATE (ไปรันgetItemต่อ)
    public function reviewMV($ITEMCODE,$FROMDATE,$TODATE) {
        $Param = array( "ITEMCODE" => $ITEMCODE,
                        "FROMDATE" => $FROMDATE,
                        "TODATE" => $TODATE,);
        $cmd = GetRequestData($Param, 'inv.InvReview.reviewMV', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

//syslogic(printStatic)	ITEMCODE,ITEMNAME,ITEMSPEC,ONHAND,BACKLOG,FROMDATE,TODATE,SYSDATE
    public function printStatic($ITEMCODE, $ITEMNAME, $ITEMSPEC,$ONHAND, $BACKLOG, $FROMDATE, $TODATE, $SYSDATE) {
        $Param = array( "ITEMCODE" => $ITEMCODE,
                        "ITEMNAME" => $ITEMNAME,
                        "ITEMSPEC" => $ITEMSPEC,
                        "ONHAND" => $ONHAND,
                        "BACKLOG" => $BACKLOG,
                        "FROMDATE" => $FROMDATE,
                        "TODATE" => $TODATE,
                        "SYSDATE" => $SYSDATE,);
        return $this->GetReques($Param, $this->APPCODE, 'printStatic');
    }
    // public function printStatic($Param) {
    //     return $this->GetReques($Param, $this->APPCODE, 'printStatic');
    // }

//syslogic(printDynamic) ITEMCODE,ITEMNAME,ITEMSPEC,ONHAND,BACKLOG,FROMDATE,TODATE,SYSDATE
    public function printDynamic($ITEMCODE, $ITEMNAME, $ITEMSPEC,$ONHAND, $BACKLOG, $FROMDATE, $TODATE, $SYSDATE) {
        $Param = array( "ITEMCODE" => $ITEMCODE,
                        "ITEMNAME" => $ITEMNAME,
                        "ITEMSPEC" => $ITEMSPEC,
                        "ONHAND" => $ONHAND,
                        "BACKLOG" => $BACKLOG,
                        "FROMDATE" => $FROMDATE,
                        "TODATE" => $TODATE,
                        "SYSDATE" => $SYSDATE,);
        return $this->GetRequesAll($Param, $this->APPCODE, 'printDynamic');
    }
    // public function printDynamic($Param) {
    //     return $this->GetReques($Param, $this->APPCODE, 'printDynamic');
    // }

    // Syslogic(get_com)

    public function get_com() {
        $Param = array();
        return $this->GetReques($Param, $this->APPCODE, 'get_com');
    }


}
?>