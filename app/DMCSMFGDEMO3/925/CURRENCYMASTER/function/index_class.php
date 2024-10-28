<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class CurrencyMaster extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'CurrencyMaster';
    }
// mas.CurrencyMaster.searchCur CURRENCYCD_S
    public function searchCur($CURRENCYCD_S) {
        $Param = array( "CURRENCYCD_S" => $CURRENCYCD_S);
        $cmd = GetRequestData($Param, 'mas.CurrencyMaster.searchCur', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

// mas.CurrencyMaster.insCur    CURRENCYCD_S,CURRENCYCD,CURRENCYDISP,CURRENCYUNITTYP,CURRENCYAMTTYP
    public function insCur($Param) {
        $cmd = GetRequestData($Param, 'mas.CurrencyMaster.insCur', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

// mas.CurrencyMaster.updCur    CURRENCYCD_S,CURRENCYCD,CURRENCYDISP,CURRENCYUNITTYP,CURRENCYAMTTYP
    public function updCur($Param) {
        $cmd = GetRequestData($Param, 'mas.CurrencyMaster.updCur', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

// mas.CurrencyMaster.delCur    CURRENCYCD_S,CURRENCYCD,CURRENCYDISP,CURRENCYUNITTYP,CURRENCYAMTTYP
    public function delCur($Param) {
        $cmd = GetRequestData($Param, 'mas.CurrencyMaster.delCur', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

// mas.CurrencyMaster.getCur    CURRENCYCD
    public function getCur($CURRENCYCD) {
        $Param = array( "CURRENCYCD" => $CURRENCYCD);
        $cmd = GetRequestData($Param, 'mas.CurrencyMaster.getCur', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }


}
?>