<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccPurTaxInfo extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_PURTAXINFO';
    }

    public function getDataAccTran($YEAR, $MONTH) {
        $Param = array('YEAR' => $YEAR, 'MONTH' => $MONTH);
        return $this->GetRequesLargeAll($Param,  $this->APPCODE, 'getDataAccTran');
    }

    public function getData($YEAR, $MONTH) {
        $Param = array('YEAR' => $YEAR, 'MONTH' => $MONTH);
        return $this->GetRequesAll($Param,  $this->APPCODE, 'getData');
    }

    public function UPTemp1($DVW) {
        $Param = array('DVW' => $DVW);
        return $this->GetReques($Param,  $this->APPCODE, 'UPTemp1');
    }

    public function UPTemp2($DVW) {
        $Param = array('DVW' => $DVW);
        return $this->GetReques($Param,  $this->APPCODE, 'UPTemp2');
    }

    public function PrintStatic2($Param) {
        return $this->GetRequesAll($Param,  $this->APPCODE, 'PrintStatic2');
    }

    public function PrintDynamic2($Param) {
        return $this->GetRequesAll($Param,  $this->APPCODE, 'PrintDynamic2');
    }

    public function load() {
        $Param = array();
        return $this->GetReques($Param,  $this->APPCODE, 'Load');
    }
}