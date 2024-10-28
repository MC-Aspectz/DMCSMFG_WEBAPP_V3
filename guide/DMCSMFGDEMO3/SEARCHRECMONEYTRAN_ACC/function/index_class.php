<?php
require_once(dirname(__FILE__, 5) . '/common/syslogic.php');
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class SearchRecMoneyTranAcc extends Syslogic {

    public $P1 = '';
    public $P2 = '';
    public $P3 = '';
    public $P4 = '';
    public $P5 = '';

    public function __construct() {
        $this->APPCODE = 'SEARCHRECMONEYTRAN_ACC';
    }

    public function searchRecMoneyTran($Param) {

        return $this->GetRequesAll($Param, $this->APPCODE, 'searchRecMoneyTran');
        
    }
}
?> 