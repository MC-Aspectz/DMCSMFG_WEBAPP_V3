<?php
require_once(dirname(__FILE__, 5) . '/common/syslogic.php');
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class SearchAccount extends Syslogic {

    public $P1 = '';
    public $P2 = '';

    public function __construct() {
        $this->APPCODE = 'SEARCHACCOUNT';
    }

    public function getAccd($P1, $P2) {
        $Param = array( 'P1' => $P1,
                        'P2' => $P2);
        return $this->GetRequesAll($Param, $this->APPCODE, 'getAccd');
    }
}
?> 
