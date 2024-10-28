<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class PartnerUnitMaster extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'PARTNERUNITMASTER';
    }

    public function getPartner($PARTNERTYP, $PARTNERCD, $ITEMCD, $PARTNERPRICEDT) {
        $Param = array( 'PARTNERTYP' => $PARTNERTYP,
                        'PARTNERCD' => $PARTNERCD,
                        'ITEMCD' => $ITEMCD,
                        'PARTNERPRICEDT' => $PARTNERPRICEDT);
        $cmd = GetRequestData($Param, 'mas.PartnerPrice.getPartner', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getIM($ITEMCD, $PARTNERTYP, $PARTNERCD) {
        $Param = array( 'ITEMCD' => $ITEMCD,
                        'PARTNERTYP' => $PARTNERTYP,
                        'PARTNERCD' => $PARTNERCD);
        $cmd = GetRequestData($Param, 'mas.PartnerPrice.getIM', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getDate($PARTNERPRICEDT) {
        $Param = array( 'PARTNERPRICEDT' => $PARTNERPRICEDT);
        $cmd = GetRequestData($Param, 'mas.PartnerPrice.getDate', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function preDate($PARTNERTYP, $PARTNERCD, $ITEMCD, $PARTNERPRICEDT) {
        $Param = array( 'PARTNERTYP' => $PARTNERTYP,
                        'PARTNERCD' => $PARTNERCD,
                        'ITEMCD' => $ITEMCD,
                        'PARTNERPRICEDT' => $PARTNERPRICEDT);
        $cmd = GetRequestData($Param, 'mas.PartnerPrice.preDate', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function nextDate($PARTNERTYP, $PARTNERCD, $ITEMCD, $PARTNERPRICEDT) {
        $Param = array( 'PARTNERTYP' => $PARTNERTYP,
                        'PARTNERCD' => $PARTNERCD,
                        'ITEMCD' => $ITEMCD,
                        'PARTNERPRICEDT' => $PARTNERPRICEDT);
        $cmd = GetRequestData($Param, 'mas.PartnerPrice.nextDate', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function nextQty($Param) {
        $cmd = GetRequestData($Param, 'mas.PartnerPrice.nextQty', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function insert($Param) {
        $cmd = GetRequestData($Param, 'mas.PartnerPrice.insert', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function update($Param) {
        $cmd = GetRequestData($Param, 'mas.PartnerPrice.update', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function delete($Param) {
        $cmd = GetRequestData($Param, 'mas.PartnerPrice.delete', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function currenttQty($PARTNERPRICEQTY1, $PARTNERPRICEQTY2) {
        $Param = array('PARTNERPRICEQTY1' => $PARTNERPRICEQTY1, 'PARTNERPRICEQTY2' => $PARTNERPRICEQTY2);
        $cmd = GetRequestData($Param, 'mas.PartnerPrice.currenttQty', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function searchPUP($Param) {
        $cmd = GetRequestData($Param, 'mas.PartnerPrice.searchPUP', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?>