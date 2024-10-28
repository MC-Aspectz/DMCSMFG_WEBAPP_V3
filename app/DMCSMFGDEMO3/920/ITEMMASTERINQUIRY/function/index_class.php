<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class ItemMasterInquiry  extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ITEMMASTERINQUIRY';
    }

    
    public function search($ITEMCD1,$ITEMCD2,$ITEMNAME,$ITEMSEARCH,$ITEMTYP
    ,$ITEMBOI,$CATALOGCD,$ITEMUNIT,$SUPPLIERCD,$STORAGECD) {
        $Param = array("ITEMCD1" => $ITEMCD1,"ITEMCD2" => $ITEMCD2,"ITEMNAME" => $ITEMNAME,"ITEMSEARCH" => $ITEMSEARCH,
        "ITEMTYP" => $ITEMTYP,"ITEMBOI" => $ITEMBOI,"CATALOGCD" => $CATALOGCD,"ITEMUNIT" => $ITEMUNIT,"SUPPLIERCD" => $SUPPLIERCD,
        "STORAGECD" => $STORAGECD);
        // ,"DEBITACCCD2" => $DEBITACCCD2,"CREDITACCCD2" => $CREDITACCCD2);
        return $this->GetRequesAll($Param, $this->APPCODE, 'Search');
    }
    
    public function getCat($CATALOGCD) {
        $Param = array("CATALOGCD" => $CATALOGCD);
        $cmd = GetRequestData($Param, 'mas.ItemMaster.getCat', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;       
    }
    public function getSup($SUPPLIERCD) {
        $Param = array("SUPPLIERCD" => $SUPPLIERCD);
        $cmd = GetRequestData($Param, 'mas.ItemMaster.getSup', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    public function getStg($STORAGECD) {
        $Param = array("STORAGECD" => $STORAGECD);
        $cmd = GetRequestData($Param, 'mas.ItemMaster.getStg', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
  
    

}
?>