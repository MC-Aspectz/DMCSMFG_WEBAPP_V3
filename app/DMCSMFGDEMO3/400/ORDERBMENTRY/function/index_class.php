<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class OrderBMEntry extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ORDERBMENTRY';
    }

    public function get($ALLOCORDERNO, $ALLOCORDERTYP) {
        $Param = array( 'ALLOCORDERNO' => $ALLOCORDERNO,
                        'ALLOCORDERTYP' => $ALLOCORDERTYP);
        $cmd = GetRequestData($Param, 'pro.AllocOrderEntry.get', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function orderSearch($ORDERNO, $ORDERLN, $ALLOCORDERTYP, $ODRQTY) {
        $Param = array( 'ORDERNO' => $ORDERNO,
                        'ORDERLN' => $ORDERLN,
                        'ALLOCORDERTYP' => $ALLOCORDERTYP,
                        'ODRQTY' => $ODRQTY);
        $cmd = GetRequestData($Param, 'pro.AllocOrderEntry.search', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getItem($ITEMCD) {
        $Param = array( 'ITEMCD' => $ITEMCD,);
        $cmd = GetRequestData($Param, 'pro.AllocOrderEntry.getItem', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getMat($MATERIALCD) {
        $Param = array( 'MATERIALCD' => $MATERIALCD);
        $cmd = GetRequestData($Param, 'pro.AllocOrderEntry.getMat', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getPItem($PITEMCD) {
        $Param = array( 'PITEMCD' => $PITEMCD);
        $cmd = GetRequestData($Param, 'pro.AllocOrderEntry.getPItem', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function remake($Param) {
        $cmd = GetRequestData($Param, 'pro.AllocOrderEntry.remake', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function commitAll($Param) {
        $cmd = GetRequestData($Param, 'pro.AllocOrderEntry.commitAll', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function proOrPur($ITEMCD, $ALLOCORDERFLG) {
        $Param = array('ITEMCD' => $ITEMCD, 'ALLOCORDERFLG' => $ALLOCORDERFLG);
        $cmd = GetRequestData($Param, 'pro.AllocOrderEntry.proOrPur', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?>