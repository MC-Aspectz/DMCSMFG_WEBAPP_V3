<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccDepeciation extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_DEPRECIATION';
    }

    public function getCalcDate($YEAR, $MONTH) {
        $Param = array('YEAR' => $YEAR, 'MONTH' => $MONTH);
        return $this->GetReques($Param,  $this->APPCODE, 'getCalcDate');
    }

    public function getData1($YEAR, $MONTH) {
        $Param = array('YEAR' => $YEAR, 'MONTH' => $MONTH);
        return $this->GetRequesAll($Param,  $this->APPCODE, 'getData1');
    }
    // DVW YEAR,MONTH,ASSETNO,CALCDT,ACCCD1,ACCCD2,AMOUNT
    public function commitData1($YEAR, $MONTH, $DATA) {
        $Param = array('YEAR' => $YEAR, 'MONTH' => $MONTH, 'DATA' => $DATA, 'DVW' => '');
        return $this->GetReques($Param,  $this->APPCODE, 'commitData1');
    }
    
    public function getIssueDt($ISSUEDATE, $YEAR, $MONTH) {
        $Param = array('ISSUEDATE' => $ISSUEDATE, 'YEAR' => $YEAR, 'MONTH' => $MONTH);
        return $this->GetReques($Param,  $this->APPCODE, 'getIssueDt');
    }

    public function getData2($YEAR, $MONTH) {
        $Param = array('YEAR' => $YEAR, 'MONTH' => $MONTH);
        return $this->GetRequesAll($Param,  $this->APPCODE, 'getData2');
    }

    // DVW2 YEAR,MONTH,VOUCHERNO,CALCDT,ACCCD1,ACCCD2,AMOUNT,ACCY,CURRENCY1,ISSUEDATE,CALCDATE
    public function commitData2($YEAR, $MONTH, $ACCY, $CURRENCY1, $ISSUEDATE, $CALCDATE, $DATA) {
        $Param = array('YEAR' => $YEAR, 'MONTH' => $MONTH, 'DATA' => $DATA, 'ACCY' => $ACCY, 'CURRENCY1' => $CURRENCY1, 'ISSUEDATE' => $ISSUEDATE, 'CALCDATE' => $CALCDATE, 'DVW2' => '', 'VOUCHERNO' => '');
        return $this->GetReques($Param,  $this->APPCODE, 'commitData2');
    }
    
    public function finished() {
        $Param = array();
        return $this->GetReques($Param,  $this->APPCODE, 'finished');
    }

    public function load() {
        $Param = array();
        return $this->GetReques($Param,  $this->APPCODE, 'Load');
    }
}
?>