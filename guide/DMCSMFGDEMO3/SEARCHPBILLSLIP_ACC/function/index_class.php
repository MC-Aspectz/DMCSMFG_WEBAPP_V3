<?php
require_once(dirname(__FILE__, 5) . '/common/syslogic.php');
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class SearchBillSlipAcc extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'SEARCHPBILLSLIP_ACC';
    }

    public function searchBill($P1, $P2, $P3, $P4, $P5) {
        $Param = array('P1' => $P1, 'P2' => $P2, 'P3' => $P3, 'P4' => $P4, 'P5' => $P5);
        return $this->GetRequesAll($Param, $this->APPCODE, 'searchBill');
    }
}
?>