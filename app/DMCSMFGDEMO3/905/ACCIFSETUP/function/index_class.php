<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class InterfaceSettingAcc  extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACCIFSETUP';
    }

    public function search($PROCESSTYPS) {
        $Param = array( 'PROCESSTYPS' => $PROCESSTYPS);
        return $this->GetRequesAll($Param, $this->APPCODE, 'search');
        // $cmd = GetRequestData($Param, 'acc.AccIfCdMaster.search', $this->APPCODE, '');
        // $data = Execute($cmd, $errorMessage);
        // return $data;
    }
    
    public function setAccEnable($Param) {
        // $Param = array( 'PROCESSTYP' => $PROCESSTYP,'INVCALCTYP' => $INVCALCTYP
        // ,'DEBITACCCD2' => $DEBITACCCD2,'CREDITACCCD2' => $CREDITACCCD2);
        return $this->GetReques($Param, $this->APPCODE, 'setAccEnable');
    }
    
    public function getAccIfCd($ITEMTYP) {
        $Param = array( 'ITEMTYP' => $ITEMTYP);
        return $this->GetReques($Param, $this->APPCODE, 'getAccIfCd');
    }
    
    public function getAccD1($DEBITACCCD1) {
        $Param = array( 'DEBITACCCD1' => $DEBITACCCD1);
        return $this->GetReques($Param, $this->APPCODE, 'getAccD1');
    }

    public function getAccD2($DEBITACCCD2) {
        $Param = array( 'DEBITACCCD2' => $DEBITACCCD2);
        return $this->GetReques($Param, $this->APPCODE, 'getAccD2');
    }
    
    public function getAccC1($CREDITACCCD1) {
        $Param = array( 'CREDITACCCD1' => $CREDITACCCD1);
        return $this->GetReques($Param, $this->APPCODE, 'getAccC1');
    }

    public function getAccC2($CREDITACCCD2) {
        $Param = array( 'CREDITACCCD2' => $CREDITACCCD2);
        return $this->GetReques($Param, $this->APPCODE, 'getAccC2');
    }
    
    public function insInterfaceset($Param) {
        //$Param = array( 'CREDITACCCD2' => $CREDITACCCD2);
        return $this->GetReques($Param, $this->APPCODE, 'insert');
    }
    
    public function updInterfaceset($Param) {
        //$Param = array( 'CREDITACCCD2' => $CREDITACCCD2);
        return $this->GetReques($Param, $this->APPCODE, 'update');
    }

    //Syslogic(delete)
    public function delInterfaceset($Param) {
        // $Param = array( 'KEYDATA' => $KEYDATA);
        return $this->GetReques($Param, $this->APPCODE, 'delete');
    }


}
?>