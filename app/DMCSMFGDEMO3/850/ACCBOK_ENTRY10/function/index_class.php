<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccBOKEntry10 extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACCBOK_ENTRY10';
    }

    public function get_header($BOOKORDERNO) {
        $Param = array("BOOKORDERNO" => $BOOKORDERNO);
        return $this->GetReques($Param,  $this->APPCODE, 'get_header');
    }

    public function get_assetn($ASSETACC) {
        $Param = array("ASSETACC" => $ASSETACC);
        return $this->GetReques($Param,  $this->APPCODE, 'get_assetn');
    }
    
    public function chkPrt($ACCY, $BOOKORDERNO, $CURRENCY1, $I_CURRENCY, $EXRATE) {
        $Param = array("ACCY" => $ACCY, "BOOKORDERNO" => $BOOKORDERNO, "CURRENCY1" => $CURRENCY1, "I_CURRENCY" => $I_CURRENCY, "EXRATE" => $EXRATE);
        return $this->GetReques($Param,  $this->APPCODE, 'chkPrt');
    }

    public function get_detail($ACCY, $BOOKORDERNO, $CURRENCY1, $I_CURRENCY, $EXRATE) {
        $Param = array("ACCY" => $ACCY, "BOOKORDERNO" => $BOOKORDERNO, "CURRENCY1" => $CURRENCY1, "I_CURRENCY" => $I_CURRENCY, "EXRATE" => $EXRATE);
        return $this->GetRequesAll($Param,  $this->APPCODE, 'get_detail');
    }

    public function get_inpStf($INP_STFCD) {
        $Param = array("INP_STFCD" => $INP_STFCD);
        return $this->GetReques($Param,  $this->APPCODE, 'get_inpStf');
    }

    public function getDiv($DIVISIONCD) {
        try {
            $Param = array("DIVISIONCD" => $DIVISIONCD);
            $cmd = GetRequestData($Param, 'acc.AccEstimateEntry.getDiv', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function set_css($CSS_TYPE) {
        $Param = array("CSS_TYPE" => $CSS_TYPE);
        return $this->GetReques($Param,  $this->APPCODE, 'set_css');
    }
    
    public function get_supllier($SUPPLIERCD) {
        $Param = array("SUPPLIERCD" => $SUPPLIERCD);
        return $this->GetReques($Param,  $this->APPCODE, 'get_supllier');
    }
    
    public function get_exrate($I_CURRENCY, $CURRENCY1) {
        $Param = array("I_CURRENCY" => $I_CURRENCY, "CURRENCY1" => $CURRENCY1);
        return $this->GetReques($Param,  $this->APPCODE, 'get_exrate');
    }
     
    public function dc_type($DC_TYPE, $ACC_CD) {
        $Param = array("DC_TYPE" => $DC_TYPE, "ACC_CD" => $ACC_CD);
        return $this->GetReques($Param,  $this->APPCODE, 'dc_type');
    }
    
    public function get_acc($ACC_CD, $DC_TYPE) {
        $Param = array("ACC_CD" => $ACC_CD, "DC_TYPE" => $DC_TYPE);
        return $this->GetReques($Param,  $this->APPCODE, 'get_acc');
    }

    public function dc_type1($AMT, $DC_TYPE, $EXRATE) {
        $Param = array("AMT" => $AMT, "DC_TYPE" => $DC_TYPE, "EXRATE" => $EXRATE);
        return $this->GetReques($Param,  $this->APPCODE, 'dc_type1');
    }

    public function inp_asset($Param) {
        return $this->GetReques($Param,  $this->APPCODE, 'inp_asset');
    }

    public function inp_AccTran($Param) {
        return $this->GetReques($Param,  $this->APPCODE, 'inp_AccTran');
    }

    public function PrintStatic($Param) {
        return $this->GetReques($Param,  $this->APPCODE, 'PrintStatic');
    }

    public function PrintDynamic($Param) {
        return $this->GetRequesAll($Param,  $this->APPCODE, 'PrintDynamic');
    }

    public function load() {
        $Param = array();
        return $this->GetReques($Param,  $this->APPCODE, 'Load');
    }
}
