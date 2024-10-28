<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class SearchGL extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'SEARCHGL';
    }

    public function getDataGL($Param) {
        return $this->GetRequesAll($Param,  $this->APPCODE, 'getDataGL');
    }
}
?>