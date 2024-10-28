<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccOutStandingAR extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_OUTSTANDINGAR';
    }

    public function searchDataOutStdAR($Param) {
        return $this->GetRequesAll($Param,  $this->APPCODE, 'SearchDataOutStdAR');
    }

    public function UpTmpOutStdAR1($DVTMPOUTSTDAR) {
    	$Param = array('DVTMPOUTSTDAR' => $DVTMPOUTSTDAR);
        return $this->GetReques($Param,  $this->APPCODE, 'UpTmpOutStdAR1');
    }

    public function GetTmpOutStdAR1($RECEIVESTATUS) {
        $Param = array('RECEIVESTATUS' => $RECEIVESTATUS);
        return $this->GetRequesAll($Param,  $this->APPCODE, 'GetTmpOutStdAR1');
    }

    public function UpTmpOutStdAR2($DVTMPOUTSTDAR) {
        $Param = array('DVTMPOUTSTDAR' => $DVTMPOUTSTDAR);
        return $this->GetReques($Param,  $this->APPCODE, 'UpTmpOutStdAR2');
    }

    public function SumByCustCurr() {
        $Param = array();
        return $this->GetRequesAll($Param,  $this->APPCODE, 'SumByCustCurr');
    }

    public function UpTmpOutStdAR2Sum($DVTMPOUTSTDAR) {
        $Param = array('DVTMPOUTSTDAR' => $DVTMPOUTSTDAR);
        return $this->GetReques($Param,  $this->APPCODE, 'UpTmpOutStdAR2Sum');
    }

    public function GetTmpOutStdAR2($RECEIVESTATUS) {
        $Param = array('RECEIVESTATUS' => $RECEIVESTATUS);
        return $this->GetRequesAll($Param,  $this->APPCODE, 'GetTmpOutStdAR2');
    }

    public function PrintStatic($Param) {
        return $this->GetReques($Param,  $this->APPCODE, 'PrintStatic');
    }

    public function PrintDynamic($Param) {
        return $this->GetRequesAll($Param,  $this->APPCODE, 'PrintDynamic');
    }
}
?>