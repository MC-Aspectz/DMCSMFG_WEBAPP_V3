<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccRecurSetup extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACCRECURSETUP';
    }

    public function chk_voucher($RECURCD) {
        $Param = array('RECURCD' => $RECURCD);
        return $this->GetReques($Param,  $this->APPCODE, 'chk_voucher');
    }

    public function getRecur($RECURCD) {
        $Param = array('RECURCD' => $RECURCD);
        return $this->GetRequesAll($Param,  $this->APPCODE, 'getRecur');
    }

    public function getRecur2($RECURCD) {
        $Param = array('RECURCD' => $RECURCD);
        return $this->GetReques($Param,  $this->APPCODE, 'getRecur2');
    }
    
    public function getRecurNo($RECURCD) {
        $Param = array('RECURCD' => $RECURCD);
        return $this->GetReques($Param,  $this->APPCODE, 'getRecurNo');
    }

    public function get_detail($CASHBOOKORDERNO, $ACCY) {
        $Param = array('CASHBOOKORDERNO' => $CASHBOOKORDERNO, 'ACCY' => $ACCY);
        return $this->GetReques($Param,  $this->APPCODE, 'get_detail');
    }

    public function get_acc($ACC_CD, $DC_TYPE) {
        $Param = array('ACC_CD' => $ACC_CD, 'DC_TYPE' => $DC_TYPE);
        return $this->GetReques($Param,  $this->APPCODE, 'get_acc');
    }

    public function commitRecurring($DVWDETAIL) {
        $Param = array('DVWDETAIL' => $DVWDETAIL);
        return $this->GetReques($Param,  $this->APPCODE, 'commitRecurring');
    }

    public function dc_type($DC_TYPE, $ACC_CD) {
        $Param = array('DC_TYPE' => $DC_TYPE, 'ACC_CD' => $ACC_CD);
        return $this->GetReques($Param,  $this->APPCODE, 'dc_type');
    }

    public function dc_type1($AMT, $DC_TYPE, $EXRATE) {
        $Param = array('AMT' => $AMT, 'DC_TYPE' => $DC_TYPE, 'EXRATE' => $EXRATE);
        return $this->GetReques($Param,  $this->APPCODE, 'dc_type1');
    }

    public function get_exrate($I_CURRENCY, $CURRENCY1, $DC_TYPE, $EXRATE) {
        $Param = array('I_CURRENCY' => $I_CURRENCY, 'CURRENCY1' => $CURRENCY1, 'DC_TYPE' => $DC_TYPE, 'EXRATE' => $EXRATE);
        return $this->GetReques($Param,  $this->APPCODE, 'get_exrate');
    }

    // public function getHeader($BOOKORDERNO) {
    //     try {
    //         $Param = array('BOOKORDERNO' => $BOOKORDERNO);
    //         $cmd = GetRequestData($Param, 'acc.THA.AccGeneralVoucherEntryRD.getHeader', $this->APPCODE, '');
    //         $data = Execute($cmd, $errorMessage);
    //         return $data;
    //     } catch (Exception $ex) {
    //         return $ex->getMessage();
    //     }
    // }

    public function load() {
        $Param = array();
        return $this->GetReques($Param,  $this->APPCODE, 'load');
    }
}
