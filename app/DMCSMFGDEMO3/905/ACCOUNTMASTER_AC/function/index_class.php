<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccounntMasterAc  extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACCOUNTMASTER_AC';
    }

    public function search($ACC_GP) {
        $Param = array( 'ACC_GP' => $ACC_GP);
        return $this->GetRequesAll($Param, $this->APPCODE, 'search_acc');
    }

    public function getAcc($ACCOUNTCD) {
        $Param = array( 'ACCOUNTCD' => $ACCOUNTCD);
        return $this->GetReques($Param, $this->APPCODE, 'get_Acc');
    }
   
    public function getCarryOverF($ACC_GRP) {
        $Param = array( 'ACC_GRP' => $ACC_GRP);
        return $this->GetReques($Param, $this->APPCODE, 'getCarryOverF');
    }
    
    public function insMasterAC($Param) {
        //$Param = array( 'CREDITACCCD2' => $CREDITACCCD2);
        return $this->GetReques($Param, $this->APPCODE, 'insert_acc');
    }
    
    public function updMasterAC($Param) {
        //$Param = array( 'CREDITACCCD2' => $CREDITACCCD2);
        return $this->GetReques($Param, $this->APPCODE, 'mody_acc');
    }
    public function delMasterAC($Param) {
        // $Param = array( 'KEYDATA' => $KEYDATA);
        return $this->GetReques($Param, $this->APPCODE, 'del_acc');
    }


    


}
?>