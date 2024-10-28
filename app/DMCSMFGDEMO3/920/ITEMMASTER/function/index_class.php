<?php
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class ItemMaster {

    public function __construct() {
        $this->APPCODE = 'ITEMMASTER';
    }

    public function getItem($ITEMCD) {
        $Param = array("ITEMCD" => $ITEMCD);
        $cmd = GetRequestData($Param, 'mas.ItemMaster.get', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getClone($ITEMCD) {
        $Param = array("ITEMCD" => $ITEMCD);
        $cmd = GetRequestData($Param, 'mas.ItemMaster.getClone', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getCategory($CATALOGCD) {
        $Param = array("CATALOGCD" => $CATALOGCD);
        $cmd = GetRequestData($Param, 'mas.ItemMaster.getCat', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;       
    }

    public function getSupplier($SUPPLIERCD) {
        $Param = array("SUPPLIERCD" => $SUPPLIERCD);
        $cmd = GetRequestData($Param, 'mas.ItemMaster.getSup', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getLocation($STORAGECD) {
        $Param = array("STORAGECD" => $STORAGECD);
        $cmd = GetRequestData($Param, 'mas.ItemMaster.getStg', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function insert($Param) {
        $cmd = GetRequestData($Param, 'mas.ItemMaster.ins', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function update($Param) {
        $cmd = GetRequestData($Param, 'mas.ItemMaster.upd', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function delete($ITEMCD) {
        $Param = array("ITEMCD" => $ITEMCD);
        $cmd = GetRequestData($Param, 'mas.ItemMaster.del', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function load() {
        $Param = array( "NOTParam" => "");
        $cmd = GetRequestData($Param, 'mas.ItemMaster.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    
}
?> 
