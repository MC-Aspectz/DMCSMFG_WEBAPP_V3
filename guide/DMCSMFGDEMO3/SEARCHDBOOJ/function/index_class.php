<?php
require_once(dirname(__FILE__, 5) . '/common/syslogic.php');
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');


class TableIndex extends Syslogic {

    
   
   

    public function __construct() {
        $this->APPCODE = 'SEARCHDBOOJ';
    }

   
   // COUNTRYCD,S_STATENAME
    public function Searchtable($P1) {
        $Param = array("P1" => $P1);
        //Syslogic(COMMON:getObjList)
        return $this->GetReques($Param, $this->APPCODE, 'COMMON:getObjList');
    }
}
?> 
