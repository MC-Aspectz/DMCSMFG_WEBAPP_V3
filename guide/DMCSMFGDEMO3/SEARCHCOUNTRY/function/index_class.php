<?php
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class CountryIndex {

    public $P1 = '';

    public function __construct() {
        $this->APPCODE = 'SEARCHCOUNTRY';
    }


    public function searchCountry($P2) {
        $Param = array( "SQLSTATEMENT" => "select DISTINCT  COUNTRYCD,COUNTRYNAME from DSCOUNTRYVW where (COUNTRYNAME like '::COUNTRYNAME_S:%')",
                        "COUNTRYNAME_S" => $P2);
        $cmd = GetRequestData($Param, 'gen.GuideReport.getResult', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

}
?> 
