<?php
require_once(dirname(__FILE__, 5) . '/common/syslogic.php');
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

//class CustomerCity  {
    class CustomerCity extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'SEARCHCITY1';
    }

 
   // COUNTRYCD,STATECD,S_CITYNAME
    public function searchCity($COUNTRYCD,$STATECD,$S_CITYNAME) {
        $Param = array( "COUNTRYCD" => $COUNTRYCD,
                        "STATECD" => $STATECD,
                        "S_CITYNAME" => $S_CITYNAME);
                        
        return $this->GetRequesAll($Param, $this->APPCODE, 'SearchCity1');
    }

    //Syslogic(SearchCity1) COUNTRYCD,STATECD,S_CITYNAME
}
?> 
