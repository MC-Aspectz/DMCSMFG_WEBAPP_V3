<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class StateEntry extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'STATEENTRY';
    }
//gen.Country.getCT COUNTRYCD
    public function getCT($COUNTRYCD) {
        $Param = array( "COUNTRYCD" => $COUNTRYCD);
        $cmd = GetRequestData($Param, 'gen.Country.getCT', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
//gen.State.search  COUNTRYCD
    public function search($COUNTRYCD) {
        $Param = array( "COUNTRYCD" => $COUNTRYCD);
        $cmd = GetRequestData($Param, 'gen.State.search', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
//gen.State.insert  COUNTRYCD,STATECD,STATENAME
    public function insert($Param) {
        $cmd = GetRequestData($Param, 'gen.State.insert', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

//gen.State.update  COUNTRYCD,STATECD,STATENAME
    public function update($Param) {
        $cmd = GetRequestData($Param, 'gen.State.update', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
//gen.State.delete  COUNTRYCD,STATECD,STATENAME
    public function delete($Param) {
        $cmd = GetRequestData($Param, 'gen.State.delete', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
//gen.State.get COUNTRYCD,STATECD,STATENAME
    public function get($COUNTRYCD,$STATECD,$STATENAME) {
        $Param = array( "COUNTRYCD" => $COUNTRYCD,
                        "STATECD" => $STATECD,
                        "STATENAME" => $STATENAME
                        );
        $cmd = GetRequestData($Param, 'gen.State.get', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        
        return $data;
    }



}
?>