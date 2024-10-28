<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccWithholdingTaxSlipTHA extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_WITHHOLDINGTAXSLIP_THA';
    }

    public function search2($D1, $D2, $D3, $D4, $D5) {
        $Param = array("D1" => $D1, "D2" => $D2, "D3" => $D3, "D4" => $D4, "D5" => $D5);
        $cmd = GetRequestData($Param, 'acc.THA.AccWithholdingTaxSlipEntry.search2', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function chkWHT($PAYMENTADD13) {
        $Param = array("PAYMENTADD13" => $PAYMENTADD13);
        $cmd = GetRequestData($Param, 'acc.THA.AccWithholdingTaxSlipEntry.chkWHT', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function update2($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.AccWithholdingTaxSlipEntry.update2', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    // EXPORT
    public function searchExpPND($D5, $DVW) {
        $Param = array("D5" => $D5, "DVW" => $DVW);
        $cmd = GetRequestData($Param, 'acc.THA.AccWithholdingTaxSlipEntry.searchExpPND', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
    // WHT
    public function printStaticWHT($DVW) {
        $Param = array("DVW" => $DVW);
        $cmd = GetRequestData($Param, 'acc.THA.AccWithholdingTaxSlipEntry.printStaticWHT', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function printDynamicWHT($DVW) {
        $Param = array("DVW" => $DVW);
        $cmd = GetRequestData($Param, 'acc.THA.AccWithholdingTaxSlipEntry.printDynamicWHT', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
    // PND53
    public function printStaticPND53($D3, $D4, $DVW) {
        $Param = array("D3" => $D3, "D4" => $D4, "DVW" => $DVW);
        $cmd = GetRequestData($Param, 'acc.THA.AccWithholdingTaxSlipEntry.printStaticPND53', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function printDynamicPND53($D3, $D4, $DVW) {
        $Param = array("D3" => $D3, "D4" => $D4, "DVW" => $DVW);
        $cmd = GetRequestData($Param, 'acc.THA.AccWithholdingTaxSlipEntry.printDynamicPND53', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    // PND3
    public function printStaticPND3($D3, $D4, $DVW) {
        $Param = array("D3" => $D3, "D4" => $D4, "DVW" => $DVW);
        $cmd = GetRequestData($Param, 'acc.THA.AccWithholdingTaxSlipEntry.printStaticPND3', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function printDynamicPND3($D3, $D4, $DVW) {
        $Param = array("D3" => $D3, "D4" => $D4, "DVW" => $DVW);
        $cmd = GetRequestData($Param, 'acc.THA.AccWithholdingTaxSlipEntry.printDynamicPND3', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.THA.AccWithholdingTaxSlipEntry.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
