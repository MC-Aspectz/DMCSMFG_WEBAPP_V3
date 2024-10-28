<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class ItemCostModify extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ITEMCOSTMODIFY';
    }

    public function getItem($Param) {
        return $this->GetReques($Param,  $this->APPCODE, 'getItem');
    }   
    
    public function update($Param) {
        return $this->GetReques($Param,  $this->APPCODE, 'update');
    }   

    public function ChkCodeTb() {
        $Param = array();
        return $this->GetReques($Param,  $this->APPCODE, 'ChkCodeTb');
    }
}
?>