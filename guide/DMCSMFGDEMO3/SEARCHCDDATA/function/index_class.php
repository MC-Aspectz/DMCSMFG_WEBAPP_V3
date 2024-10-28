<?php
require_once(dirname(__FILE__, 5) . '/common/syslogic.php');
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class SearchCDData extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'SEARCHCDDATA';
    }

    public function SearchData($P1) {
        $Param = array('P1' => $P1);
        return $this->GetRequesAll($Param, $this->APPCODE, 'SearchData');
        
    }
}
?>