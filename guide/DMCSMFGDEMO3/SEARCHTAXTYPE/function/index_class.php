<?php
require_once(dirname(__FILE__, 5) . '/common/syslogic.php');
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');


class TaxCodeIndex extends Syslogic {

    // public function __construct() {
    //     $this->APPCODE = 'SEARCHTAXTYPE';
    // }

    // public function getResult($COUNTRYCD_S) {
    //     $Param = array( "COUNTRYCD_S" => $COUNTRYCD_S,
    //                     "SQLSTATEMENT"=> "select DISTINCT  STATECD,STATENAME from DSSTATEVW where (COUNTRYCD like '::COUNTRYCD_S:%') and (STATECD like '::STATECD_S:%')");
    //     $cmd = GetRequestData($Param, 'gen.GuideReport.getResult', 'SEARCHTAXTYPE', '');
    //     $data = Execute($cmd, $errorMessage);
    //     return $data;
    // }

    public function __construct() {
        $this->APPCODE = 'TaxType';
    }

//gen.TaxTypeEntry.search  TAXTYPESEARCH
    public function search($TAXTYPESEARCH) {
        $Param = array( "TAXTYPESEARCH" => $TAXTYPESEARCH);
        $cmd = GetRequestData($Param, 'gen.TaxTypeEntry.search', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }


}
?> 
