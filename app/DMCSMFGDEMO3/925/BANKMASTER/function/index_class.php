<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class BankMaster extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'BANKMASTER';
    }
// mas.BankMaster.searchBank
    public function searchBank($BANKCD_S) {
        $Param = array( "BANKCD_S" => $BANKCD_S);
        $cmd = GetRequestData($Param, 'mas.BankMaster.searchBank', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

// mas.BankMaster.insBank  BANKCD_S,BANKCD,BANKNAME
    public function insBank($Param) {
        $cmd = GetRequestData($Param, 'mas.BankMaster.insBank', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

// mas.BankMaster.updBank   BANKCD_S,BANKCD,BANKNAME
    public function updBank($Param) {
        $cmd = GetRequestData($Param, 'mas.BankMaster.updBank', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

// mas.BankMaster.delBank   BANKCD_S,BANKCD
    public function delBank($Param) {
        $cmd = GetRequestData($Param, 'mas.BankMaster.delBank', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getBank($BANKCD) {
        $Param = array( "BANKCD" => $BANKCD);
        $cmd = GetRequestData($Param, 'mas.BankMaster.getBank', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }





}
?>