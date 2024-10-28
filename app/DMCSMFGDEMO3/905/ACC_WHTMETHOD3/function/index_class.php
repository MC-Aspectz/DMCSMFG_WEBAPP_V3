<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class CustomerHoldWithTax  extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_WHTMETHOD3';
    }
   
    public function getCus($CUSTOMERCD) {
        $Param = array('CUSTOMERCD' => $CUSTOMERCD);
        // ,'DEBITACCCD2' => $DEBITACCCD2,'CREDITACCCD2' => $CREDITACCCD2);
        return $this->GetReques($Param, $this->APPCODE, 'get_cus');
    }

    public function search($CUSTOMERCD) {
        $Param = array('CUSTOMERCD' => $CUSTOMERCD);
        // ,'DEBITACCCD2' => $DEBITACCCD2,'CREDITACCCD2' => $CREDITACCCD2);
        return $this->GetRequesAll($Param, $this->APPCODE, 'search');
    }
   
    public function getAcc1($ACC_CD1) {
        $Param = array( 'ACC_CD1' => $ACC_CD1);
        return $this->GetReques($Param, $this->APPCODE, 'get_acc1');
    }
    
    public function getAcc2($ACC_CD2) {
        $Param = array( 'ACC_CD2' => $ACC_CD2);
        return $this->GetReques($Param, $this->APPCODE, 'get_acc2');
    }
   
    public function getAcc3($ACC_CD3) {
        $Param = array( 'ACC_CD3' => $ACC_CD3);
        return $this->GetReques($Param, $this->APPCODE, 'get_acc3');
    }


    public function Commits($Param) {
       
        return $this->GetReques($Param, $this->APPCODE, 'commit');
    }

   
   
    public function delWhtmethod($Param) {
       
        return $this->GetReques($Param, $this->APPCODE, 'delete');
    }

    

}
?>