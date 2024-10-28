<?php
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class ProductionOrderEntry {

    public function __construct() {
        $this->APPCODE = 'PRODUCTIONORDERENTRY';
    }

    public function getProduct($PROORDERNO) {
        $Param = array('PROORDERNO' => $PROORDERNO);
        $cmd = GetRequestData($Param, 'pro.ProductionOrderEntry.get', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getItem($ITEMCD) {
        $Param = array('ITEMCD' => $ITEMCD);
        $cmd = GetRequestData($Param, 'pro.ProductionOrderEntry.getItem', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getLoc($LOCTYP, $LOCCD) {
        $Param = array('LOCTYP' => $LOCTYP, 'LOCCD' => $LOCCD);
        $cmd = GetRequestData($Param, 'pro.ProductionOrderEntry.getLoc', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getWc($WCCD) {
        $Param = array('WCCD' => $WCCD);
        $cmd = GetRequestData($Param, 'pro.ProductionOrderEntry.getWc', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;       
    }

    public function getStaff($STAFFCD) {
        $Param = array('STAFFCD' => $STAFFCD);
        $cmd = GetRequestData($Param, 'pro.ProductionOrderEntry.getStaff', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getPlanDate($Param) {
        $cmd = GetRequestData($Param, 'pro.ProductionOrderEntry.getPlanDate', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getSaleOrderNoLn($SALEORDERNOLN) {
        $Param = array('SALEORDERNOLN' => $SALEORDERNOLN);
        $cmd = GetRequestData($Param, 'pro.ProductionOrderEntry.getSaleOrderNoLn', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getProPtn($ITEMPROPTNCD) {
        $Param = array('ITEMPROPTNCD' => $ITEMPROPTNCD);
        $cmd = GetRequestData($Param, 'mas.ItemMaster.getProPtn', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function checkBmVersion($PROORDERNO, $ITEMCD, $BMVERSION) {
       	$Param = array('PROORDERNO' => $PROORDERNO, 'ITEMCD' => $ITEMCD, 'BMVERSION' => $BMVERSION);
        $cmd = GetRequestData($Param, 'pro.ProductionOrderEntry.checkBmVersion', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function insert($Param) {
        $cmd = GetRequestData($Param, 'pro.ProductionOrderEntry.ins', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function update($Param) {
        $cmd = GetRequestData($Param, 'pro.ProductionOrderEntry.upd', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function delete($ACTION, $PROORDERNO) {
        $Param = array('ACTION' => $ACTION, 'PROORDERNO' => $PROORDERNO);
        $cmd = GetRequestData($Param, 'pro.ProductionOrderEntry.ChangeDel', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function checkStatus($PROSTATUS) {
        $Param = array('PROSTATUS' => $PROSTATUS);
        $cmd = GetRequestData($Param, 'pro.ProductionOrderEntry.checkStatus', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function load() {
        $Param = array( 'NOTParam' => '');
        $cmd = GetRequestData($Param, 'pro.ProductionOrderEntry.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function loadForm($Param) {
        $cmd = GetRequestData($Param, 'gen.Application.loadForm', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?> 
