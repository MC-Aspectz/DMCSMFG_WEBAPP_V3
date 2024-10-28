<?php
require_once(dirname(__FILE__, 5) . '/common/syslogic.php');
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');


class CustomerState extends Syslogic {

    
   
   

    public function __construct() {
        $this->APPCODE = 'SEARCHSTATE1';
    }

   
   // COUNTRYCD,S_STATENAME
    public function searchState($STATENAME,$COUNTRYCD) {
        $Param = array("S_STATENAME" => $STATENAME,
        "COUNTRYCD" => $COUNTRYCD);
        return $this->GetRequesAll($Param, $this->APPCODE, 'SearchState1');
    }
}
?> 
