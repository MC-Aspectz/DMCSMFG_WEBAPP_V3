<?php
require_once(dirname(__FILE__, 5) . '/common/syslogic.php');
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class SearchBillNO extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'SEARCHBILLNO';
    }

    public function getName($CD) {
        $Param = array('CD' => $CD);
        return $this->GetReques($Param, $this->APPCODE, 'getName');
        
    }

    public function getBill($BN, $CD, $D1, $D2, $C1) {
        $Param = array('BN' => $BN, 'CD' => $CD, 'D1' => $D1, 'D2' => $D2, 'C1' => $C1);
        return $this->GetRequesAll($Param, $this->APPCODE, 'getBill');
        
    }
}
?> 