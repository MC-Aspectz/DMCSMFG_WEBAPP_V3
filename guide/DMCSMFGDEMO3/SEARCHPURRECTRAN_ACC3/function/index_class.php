<?php
require_once(dirname(__FILE__, 5) . '/common/syslogic.php');
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class SearchPurRecTran extends Syslogic {

    public $P1 = '';
    public $P2 = '';
    public $P3 = '';
    public $P4 = '';
    public $P5 = '';

    public function __construct() {
        $this->APPCODE = 'SEARCHPURRECTRAN_ACC3';
    }

    public function searchPurRecTran($Param) {

        return $this->GetRequesAll($Param, $this->APPCODE, 'searchPurRecTran');
        
    }
}
?> 
