<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class CatalogMaster extends Syslogic {

    // ----------------------------------------------------------------------------------------------------
    public $formloadobj = array();
    // ----------------------------------------------------------------------------------------------------

    public function __construct() {
        // --------------------------------------------------
        $this->APPCODE = 'CATALOGMASTER';
        // --------------------------------------------------
        // $Param = array( "CATALOGCD_S" => '');
        // $cmd = GetRequestData($Param, 'gen.Application.getLoadApp', $this->APPCODE, '');
        // $data = Execute($cmd, $errorMessage);
        // $formloadobj = $data;
        // if(!empty($data)) {
        //     foreach ($data as $key => $value) {
        //         if ($value['FType'] == 'CD' + $_SESSION['LANG']) {
        //             if($value['FKey'] == 'VALUE') {
        //                 print_r($value['FValue']);
        //             }
        //         }
        //     }  // foreach ($data as $key => $value) {
        // }  // if(!empty($data)) {
        // --------------------------------------------------
    }

    public function appLoad() {
        // --------------------------------------------------
        print_r("App Load.");
        $Param = array( "CATALOGCD_S" => '');
        $cmd = GetRequestData($Param, 'gen.Application.getLoadApp', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        $formloadobj = $data;
        if(!empty($data)) {
            foreach ($data as $key => $value) {
                if ($value['FType'] == 'CD' + $_SESSION['LANG']) {
                    if($value['FKey'] == 'VALUE') {
                        print_r($value['FValue']);
                    }
                }
            }  // foreach ($data as $key => $value) {
        }  // if(!empty($data)) {
        // --------------------------------------------------
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