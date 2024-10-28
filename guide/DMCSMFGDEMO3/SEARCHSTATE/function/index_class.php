<?php
require_once(dirname(__FILE__, 5) . '/common/syslogic.php');
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');


class CustomerState extends Syslogic {

    
   
   

    public function __construct() {
        $this->APPCODE = 'SEARCHSTATE';
    }

   

    public function getResult($COUNTRYCD_S,$STATECD_S) {
        $Param = array( "COUNTRYCD_S" => $COUNTRYCD_S,
                        "STATECD_S" => $STATECD_S,
                        "SQLSTATEMENT"=> "select DISTINCT  STATECD,STATENAME from DSSTATEVW where (COUNTRYCD like '::COUNTRYCD_S:%') and (STATECD like '::STATECD_S:%')");
        $cmd = GetRequestData($Param, 'gen.GuideReport.getResult', 'SEARCHSTATE', '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
 

}
?> 
