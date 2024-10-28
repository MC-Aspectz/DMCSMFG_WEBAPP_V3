<?php
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class WarehousingIndex {

    public function __construct() {
        $this->APPCODE = 'SEARCHPROTRAN';
    }

    //select DISTINCT  ProTranOrderNo,ProTranDt,ProTranQty from dsprotranvw where (ProTranProOrderNo like '170200001') and (ProTranOrderNo like 'MT000000003')
    public function searchWarehouse($P1,$P2) {
        $Param = array( 'SQLSTATEMENT' => "select DISTINCT  ProTranOrderNo,ProTranDt,ProTranQty from dsprotranvw where (ProTranProOrderNo like '::ProductionOrder:%') and (ProTranOrderNo like '::VoucherNo:%')",
                        'ProductionOrder' => $P1,
                        'VoucherNo' => $P2);
        $cmd = GetRequestData($Param, 'gen.GuideReport.getResult', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 
