<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class ItemMasterMFG extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ITEMMASTER_MFG';
    }

    public function search($SEARCHITEMCD1, $SEARCHITEMCD2, $SEARCHITEMNAME, $SEARCHITEMTYPE, $SEARCHITEMCATCD, $SEARCHITEMSTORAGECD) {
        $Param = array( 'SEARCHITEMCD1' => $SEARCHITEMCD1,
                        'SEARCHITEMCD2' => $SEARCHITEMCD2,
                        'SEARCHITEMNAME' => $SEARCHITEMNAME,
                        'SEARCHITEMTYPE' => $SEARCHITEMTYPE,
                        'SEARCHITEMCATCD' => $SEARCHITEMCATCD,
                        'SEARCHITEMSTORAGECD' => $SEARCHITEMSTORAGECD);
        $cmd = GetRequestData($Param, 'mas.THA.ItemMaster_MFG.search', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getSearchItemCategory($SEARCHITEMCATCD) {
        $Param = array('SEARCHITEMCATCD' => $SEARCHITEMCATCD);
        $cmd = GetRequestData($Param, 'mas.THA.ItemMaster_MFG.getSearchItemCategory', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;       
    }

    public function getSearchItemLocation($SEARCHITEMSTORAGECD) {
        $Param = array('SEARCHITEMSTORAGECD' => $SEARCHITEMSTORAGECD);
        $cmd = GetRequestData($Param, 'mas.THA.ItemMaster_MFG.getSearchItemLocation', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getItem($ITEMCD) {
        $Param = array('ITEMCD' => $ITEMCD);
        $cmd = GetRequestData($Param, 'mas.THA.ItemMaster_MFG.get', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getClone($ITEMCLONE) {
        $Param = array('ITEMCLONE' => $ITEMCLONE);
        $cmd = GetRequestData($Param, 'mas.THA.ItemMaster_MFG.getClone', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getCat($CATALOGCD) {
        $Param = array('CATALOGCD' => $CATALOGCD);
        $cmd = GetRequestData($Param, 'mas.THA.ItemMaster_MFG.getCat', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;       
    }

    public function getSup($SUPPLIERCD) {
        $Param = array('SUPPLIERCD' => $SUPPLIERCD);
        $cmd = GetRequestData($Param, 'mas.THA.ItemMaster_MFG.getSup', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getStg($STORAGECD) {
        $Param = array('STORAGECD' => $STORAGECD);
        $cmd = GetRequestData($Param, 'mas.THA.ItemMaster_MFG.getStg', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getWc($WCCD) {
        $Param = array('WCCD' => $WCCD);
        $cmd = GetRequestData($Param, 'mas.THA.ItemMaster_MFG.getWc', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getMat($MATERIALCD) {
        $Param = array('MATERIALCD' => $MATERIALCD);
        $cmd = GetRequestData($Param, 'mas.THA.ItemMaster_MFG.getMat', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function save($Param) {
        $cmd = GetRequestData($Param, 'mas.THA.ItemMaster_MFG.save', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function delete($ITEMCD) {
        $Param = array('ITEMCD' => $ITEMCD);
        $cmd = GetRequestData($Param, 'mas.THA.ItemMaster_MFG.del', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function load() {
        $Param = array( 'NOParam' => '');
        $cmd = GetRequestData($Param, 'mas.THA.ItemMaster_MFG.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function change_vis() {
        $Param = array();
        return $this->GetReques($Param, $this->APPCODE, 'change_vis');
    }
}
?> 
