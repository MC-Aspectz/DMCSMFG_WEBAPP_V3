<?php
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class StockUpMonth {

    public function __construct() {
        $this->APPCODE = 'CLEARANCEMONTHUPDATE';
    }

    public function Load() {
        $Param = array( "NOTParam" => "");
        $cmd = GetRequestData($Param, 'inv.ClearanceMonthUpdate.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
       
    }
    public function RunClearanceMonthUpdates($Param) {
        $cmd = GetRequestData($Param, 'inv.ClearanceMonthUpdate.commit', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
       
    }

    
 

}
?> 
