<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class CountryEntry extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'COUNTRYENTRY';
    }
// gen.Country.search   COUNTRYSEARCH
    public function search($COUNTRYSEARCH) {
        $Param = array( "COUNTRYSEARCH" => $COUNTRYSEARCH);
        $cmd = GetRequestData($Param, 'gen.Country.search', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

// gen.Country.insert  COUNTRYCD,COUNTRYNAME,COUNTRYSEARCH
    public function insert($Param) {
        $cmd = GetRequestData($Param, 'gen.Country.insert', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

// gen.Country.update   COUNTRYCD,COUNTRYNAME,COUNTRYSEARCH
    public function update($Param) {
        $cmd = GetRequestData($Param, 'gen.Country.update', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

// gen.Country.delete   COUNTRYCD,COUNTRYNAME,COUNTRYSEARCH
    public function delete($Param) {
        $cmd = GetRequestData($Param, 'gen.Country.delete', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
// gen.Country.get  COUNTRYCD,COUNTRYNAME   
    public function get($COUNTRYCD,$COUNTRYNAME) {
        $Param = array( "COUNTRYCD" => $COUNTRYCD,
                        "COUNTRYNAME" => $COUNTRYNAME
    );
        $cmd = GetRequestData($Param, 'gen.Country.get', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }





}
?>