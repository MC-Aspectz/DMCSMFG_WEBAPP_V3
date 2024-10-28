<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccINCVO extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_INCVO';
    }

    public function get_header($BOOKORDERNO, $ACCY) {
        $Param = array('BOOKORDERNO' => $BOOKORDERNO, 'ACCY' => $ACCY);
        return $this->GetReques($Param,  $this->APPCODE, 'get_header');
    }

    public function get_detail($BOOKORDERNO, $ACCY) {
        $Param = array('BOOKORDERNO' => $BOOKORDERNO, 'ACCY' => $ACCY);
        return $this->GetRequesAll($Param,  $this->APPCODE, 'get_detail');
    }

    public function chk_voucher($BOOKORDERNO, $ACCY) {
        $Param = array('BOOKORDERNO' => $BOOKORDERNO, 'ACCY' => $ACCY);
        return $this->GetReques($Param,  $this->APPCODE, 'chk_voucher');
    }

    public function get_inpStf($CSS_TYPE) {
        $Param = array('CSS_TYPE' => $CSS_TYPE);
        return $this->GetReques($Param,  $this->APPCODE, 'get_inpStf');
    }

    public function getDivision($DIVISIONCD) {
        try {
            $Param = array("DIVISIONCD" => $DIVISIONCD);
            $cmd = GetRequestData($Param, 'sale.SaleEntry.getDivision', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function set_css($CSS_TYPE) {
        $Param = array('CSS_TYPE' => $CSS_TYPE);
        return $this->GetReques($Param,  $this->APPCODE, 'set_css');
    }

    public function get_customer($CUSTOMERCODE) {
        $Param = array('CUSTOMERCODE' => $CUSTOMERCODE);
        return $this->GetReques($Param,  $this->APPCODE, 'get_customer');
    }

    public function get_exrate($I_CURRENCY, $ACCY) {
        $Param = array('I_CURRENCY' => $I_CURRENCY, 'ACCY' => $ACCY);
        return $this->GetReques($Param,  $this->APPCODE, 'get_exrate');
    }

    public function load() {
        $Param = array();
        return $this->GetReques($Param,  $this->APPCODE, 'load');
    }
}
?>