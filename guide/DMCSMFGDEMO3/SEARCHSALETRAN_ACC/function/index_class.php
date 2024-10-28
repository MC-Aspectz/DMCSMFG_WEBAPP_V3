<?php
require_once(dirname(__FILE__, 5) . '/common/syslogic.php');
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class SaleTran extends Syslogic {

    public $P1 = '';
    public $P2 = '';
    public $P3 = '';
    public $P4 = '';
    public $P5 = '';

    public function __construct() {
        $this->APPCODE = 'SEARCHSALETRAN_ACC';
    }

    public function searchSaleTran($Param) {

        return $this->GetRequesAll($Param, $this->APPCODE, 'searchSaleTran');
        
    }
}
?> 
