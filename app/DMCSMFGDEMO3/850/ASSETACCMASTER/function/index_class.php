<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AssetMaster  extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ASSETACCMASTER';
    }
    
    public function search() {
       $Param = array();
        return $this->GetReques($Param, $this->APPCODE, 'get_info');
    }
    
    

    public function CheckAssetAcc($ASSETACCCD) {
        $Param = array( "ASSETACCCD" => $ASSETACCCD);
        return $this->GetReques($Param, $this->APPCODE, 'check_assetacc');
    }
    

    public function get_accd1($ASSETACCOUNT) {
        $Param = array( "ASSETACCOUNT" => $ASSETACCOUNT);
        return $this->GetReques($Param, $this->APPCODE, 'get_accd1');
    }
    
    

    public function get_accd2($DEPLECIATION) {
        $Param = array( "DEPLECIATION" => $DEPLECIATION);
        return $this->GetReques($Param, $this->APPCODE, 'get_accd2');
    }
    
    public function get_accd3($ACCUMULATED) {
        $Param = array( "ACCUMULATED" => $ACCUMULATED);
        return $this->GetReques($Param, $this->APPCODE, 'get_accd3');
    }
   
    public function insAssMaster($Param) {
        //$Param = array( "CREDITACCCD2" => $CREDITACCCD2);
        return $this->GetReques($Param, $this->APPCODE, 'ins_data');
    }
    

    
    public function updAssMaster($Param) {
        //$Param = array( "CREDITACCCD2" => $CREDITACCCD2);
        return $this->GetReques($Param, $this->APPCODE, 'upd_data');
    }
   
    public function delAssMaster($Param) {
        // $Param = array( "KEYDATA" => $KEYDATA);
        return $this->GetReques($Param, $this->APPCODE, 'del_data');
    }
  


}
?>