<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccWithholdingTaxSlip extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_INPUTWITHHOLDINGTAXSLIP';
    }

    public function search($D1, $D2) {
        $Param = array("D1" => $D1, "D2" => $D2);
        $cmd = GetRequestData($Param, 'acc.AccWithholdingTaxSlipEntry.search', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function update($Param) {
        $cmd = GetRequestData($Param, 'acc.AccWithholdingTaxSlipEntry.update', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    // WHT
    public function printStaticWHT($WHT_T1, $WHT_T2, $WHT_T3, $WHT_T4, $DVW) {
        $Param = array("WHT_T1" => $WHT_T1, "WHT_T2" => $WHT_T2, "WHT_T3" => $WHT_T3, "WHT_T4" => $WHT_T4, "DVW" => $DVW);
        $cmd = GetRequestData($Param, 'acc.AccPrint.printStaticWHT', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function printDynamicWHT($WHT_T1, $WHT_T2, $WHT_T3, $WHT_T4, $DVW) {
        $Param = array("WHT_T1" => $WHT_T1, "WHT_T2" => $WHT_T2, "WHT_T3" => $WHT_T3, "WHT_T4" => $WHT_T4, "DVW" => $DVW);
        $cmd = GetRequestData($Param, 'acc.AccPrint.printDynamicWHT', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    // PND53
    public function commitPND53($PAYMENTADD08) {
        $Param = array("PAYMENTADD08" => $PAYMENTADD08);
        return $this->GetReques($Param,  $this->APPCODE, 'commitPND53');
    }

    public function PND53PrintStatic($PAYMENTADD08) {
        $Param = array("PAYMENTADD08" => $PAYMENTADD08);
        return $this->GetReques($Param,  $this->APPCODE, 'PND53PrintStatic');
    }

    public function PND53PrintDynamic($PAYMENTADD08) {
        $Param = array("PAYMENTADD08" => $PAYMENTADD08);
        return $this->GetReques($Param,  $this->APPCODE, 'PND53PrintDynamic');
    }

    // PND3
    public function PND3PrintStatic($PAYMENTADD08) {
        $Param = array("PAYMENTADD08" => $PAYMENTADD08);
        return $this->GetReques($Param,  $this->APPCODE, 'PND3PrintStatic');
    }

    public function PND3PrintDynamic($PAYMENTADD08) {
        $Param = array("PAYMENTADD08" => $PAYMENTADD08);
        return $this->GetReques($Param,  $this->APPCODE, 'PND3PrintDynamic');
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.THA.AccWithholdingTaxSlipEntry.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
