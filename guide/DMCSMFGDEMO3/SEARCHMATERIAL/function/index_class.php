<?php
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class MaterialIndex {

    public function __construct() {
        $this->APPCODE = 'SEARCHMATERIAL';
    }

    public function searchMaterial($P1,$P2) {
        $Param = array( 'SQLSTATEMENT' => "select DISTINCT  MaterialCd,MaterialName,MaterialParentCd,MaterialSpec,MaterialNote from DsMaterialVw where (MaterialCd like '::MaterialCode:%') and (MaterialParentCd like '::MaterialParentCode:%')", 'MaterialCode' => $P1, 'MaterialParentCode' => $P2);
        $cmd = GetRequestData($Param, 'gen.GuideReport.getResult', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 
