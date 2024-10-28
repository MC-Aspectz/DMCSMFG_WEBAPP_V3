<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class OrderRoutingEntry extends Syslogic{

    public function __construct() {
        $this->APPCODE = 'ORDERROUTINGENTRY';
    }

    public function searchDetail($PROORDERNO) {
        $Param = array( 'PROORDERNO' => $PROORDERNO);
        $cmd = GetRequestData($Param, 'pro.OrderRoutingEntry.searchDetail', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getProOdr($PROORDERNO) {
        $Param = array( 'PROORDERNO' => $PROORDERNO);
        $cmd = GetRequestData($Param, 'pro.OrderRoutingEntry.getProOdr', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getPlace($PROPSSTYP, $ITEMPLACECD) {
        $Param = array( 'PROPSSTYP' => $PROPSSTYP, 'ITEMPLACECD' => $ITEMPLACECD);
        $cmd = GetRequestData($Param, 'pro.OrderRoutingEntry.getPlace', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getJobCode($PROPSSJOBTYP) {
        $Param = array( 'PROPSSJOBTYP' => $PROPSSJOBTYP);
        $cmd = GetRequestData($Param, 'pro.OrderRoutingEntry.getJobCode', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getProPtn($ITEMPROPTNCD) {
        $Param = array( 'ITEMPROPTNCD' => $ITEMPROPTNCD);
        $cmd = GetRequestData($Param, 'mas.ItemMaster.getProPtn', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function commitAll($Param) {
        $cmd = GetRequestData($Param, 'pro.OrderRoutingEntry.commitAll', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function remake($PROORDERNO, $ITEMPROPTNCD) {
        $Param = array( 'PROORDERNO' => $PROORDERNO, 'ITEMPROPTNCD' => $ITEMPROPTNCD);
        $cmd = GetRequestData($Param, 'pro.OrderRoutingEntry.remake', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 
