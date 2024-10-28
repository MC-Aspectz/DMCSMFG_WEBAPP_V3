<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');


class CityEntry extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'CITYENTRY';
    }

//gen.City.getCT    COUNTRYCD
    public function getCT($COUNTRYCD) {
        $Param = array( "COUNTRYCD" => $COUNTRYCD);
        $cmd = GetRequestData($Param, 'gen.City.getCT', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

//gen.City.getST    STATECD
    public function getST($COUNTRYCD,$STATECD) {
        $Param = array( "COUNTRYCD" => $COUNTRYCD,
                        "STATECD" => $STATECD);
        $cmd = GetRequestData($Param, 'gen.City.getST', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

//gen.City.search   COUNTRYCD,STATECD
    public function search($COUNTRYCD,$STATECD) {
        $Param = array( "COUNTRYCD" => $COUNTRYCD,
                        "STATECD" => $STATECD);
        $cmd = GetRequestData($Param, 'gen.City.search', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

//gen.City.insert   STATECD,COUNTRYCD,CITYCD,CITYNAME
    public function insert($Param) {
        $cmd = GetRequestData($Param, 'gen.City.insert', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

//gen.City.update   STATECD,COUNTRYCD,CITYCD,CITYNAME
    public function update($Param) {
        $cmd = GetRequestData($Param, 'gen.City.update', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    
//gen.City.delete   STATECD,COUNTRYCD,CITYCD,CITYNAME
    public function delete($Param) {
        $cmd = GetRequestData($Param, 'gen.City.delete', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

//gen.City.getCity  STATECD,COUNTRYCD,CITYCD,CITYNAME
    public function get($STATECD,$COUNTRYCD,$CITYCD,$CITYNAME) {
        $Param = array( "STATECD" => $STATECD,
                        "COUNTRYCD" => $COUNTRYCD,
                        "CITYCD" => $CITYCD,
                        "CITYNAME" => $CITYNAME
                        );
        $cmd = GetRequestData($Param, 'gen.City.get', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }



}
?>