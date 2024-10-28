<?php
require_once(dirname(__FILE__, 5) . '/common/syslogic.php');
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class PurchaseRequest extends Syslogic {

    public $P1 = '';

    public function __construct() {
        $this->APPCODE = 'SEARCHPURCHASEREQUEST';
    }

    public function searchPurReq($P1) {
        $Param = array("P1" => $P1);
        $cmd = GetRequestData($Param, 'search.SearchGeneral.searchPurReq', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 
