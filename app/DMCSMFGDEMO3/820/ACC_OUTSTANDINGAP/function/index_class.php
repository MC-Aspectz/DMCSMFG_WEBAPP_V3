<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccOutStandingAP extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_OUTSTANDINGAP';
    }

    public function SearchDataOutStdAP($Param) {
        return $this->GetRequesAll($Param,  $this->APPCODE, 'SearchDataOutStdAP');
    }

    public function UpTmpOutStdAP1($DVTMPOUTSTDAP) {
    	$Param = array("DVTMPOUTSTDAP" => $DVTMPOUTSTDAP);
        return $this->GetReques($Param,  $this->APPCODE, 'UpTmpOutStdAP1');
    }

    public function SearchDataPay() {
        $Param = array();
        return $this->GetRequesAll($Param,  $this->APPCODE, 'SearchDataPay');
    }

    public function UpTmpPay($DVTMPOUTSTDAP2) {
        $Param = array("DVTMPOUTSTDAP2" => $DVTMPOUTSTDAP2);
        return $this->GetReques($Param,  $this->APPCODE, 'UpTmpPay');
    }

    public function CalDataOutStd() {
        $Param = array();
        return $this->GetRequesAll($Param,  $this->APPCODE, 'CalDataOutStd');
    }

    public function UpTmpOutStd($DVTMPOUTSTDAP2) {
        $Param = array("DVTMPOUTSTDAP2" => $DVTMPOUTSTDAP2);
        return $this->GetReques($Param,  $this->APPCODE, 'UpTmpOutStd');
    }
    
    public function GetTmpOutStdAP1($PAYMENTSTATUS) {
        $Param = array("PAYMENTSTATUS" => $PAYMENTSTATUS);
        return $this->GetRequesAll($Param,  $this->APPCODE, 'GetTmpOutStdAP1');
    }

    public function UpTmpOutStdAP2($DVTMPOUTSTDAP) {
        $Param = array("DVTMPOUTSTDAP" => $DVTMPOUTSTDAP);
        return $this->GetReques($Param,  $this->APPCODE, 'UpTmpOutStdAP2');
    }

    public function SumBySuppCurr() {
        $Param = array();
        return $this->GetRequesAll($Param,  $this->APPCODE, 'SumBySuppCurr');
    }

    public function UpTmpOutStdAP2Sum($DVTMPOUTSTDAP) {
        $Param = array("DVTMPOUTSTDAP" => $DVTMPOUTSTDAP);
        return $this->GetReques($Param,  $this->APPCODE, 'UpTmpOutStdAP2Sum');
    }

    public function GetTmpOutStdAP2() {
        $Param = array();
        return $this->GetRequesAll($Param,  $this->APPCODE, 'GetTmpOutStdAP2');
    }

    public function PrintStatic($Param) {
        return $this->GetReques($Param,  $this->APPCODE, 'PrintStatic');
    }

    public function PrintDynamic($Param) {
        return $this->GetRequesAll($Param,  $this->APPCODE, 'PrintDynamic');
    }
}
?>