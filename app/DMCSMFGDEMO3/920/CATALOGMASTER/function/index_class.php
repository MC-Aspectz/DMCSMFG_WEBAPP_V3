<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class CatalogMaster extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'CATALOGMASTER';
    }

    public function search($CATALOGCD_S) {
        $Param = array( "CATALOGCD_S" => $CATALOGCD_S);
        $cmd = GetRequestData($Param, 'mas.CatalogMaster.search', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getCatalog($CATALOGCD) {
        $Param = array( "CATALOGCD" => $CATALOGCD);
        $cmd = GetRequestData($Param, 'mas.CatalogMaster.getCatalog', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function insCatalog($Param) {
        $cmd = GetRequestData($Param, 'mas.CatalogMaster.insCatalog', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function updCatalog($Param) {
        $cmd = GetRequestData($Param, 'mas.CatalogMaster.updCatalog', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function delCatalog($Param) {
        $cmd = GetRequestData($Param, 'mas.CatalogMaster.delCatalog', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getAccIfCd($ACCIFCD) {
        $Param = array( "ACCIFCD" => $ACCIFCD);
        $cmd = GetRequestData($Param, 'mas.CatalogMaster.getAccIfCd', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?>