<?php
require_once(dirname(__FILE__, 5) . '/common/syslogic.php');
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class SaleTranForDC2ACC extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'SEARCHSALETRANFORDC2_ACC';
    }

    public function searchSaleTran($Param) {

        return $this->GetRequesAll($Param, $this->APPCODE, 'searchSaleTran');
        
    }
}
?> 
