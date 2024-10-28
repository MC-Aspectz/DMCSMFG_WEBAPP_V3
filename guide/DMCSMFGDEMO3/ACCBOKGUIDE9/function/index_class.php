<?php
require_once(dirname(__FILE__, 5) . '/common/syslogic.php');
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class AccbokGuide9 extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACCBOKGUIDE9';
    }

    public function get_data($Param) {

        return $this->GetRequesAll($Param, $this->APPCODE, 'get_data');
        
    }

    public function get_staff($STAFFCD) {
        $Param = array('STAFFCD' => $STAFFCD);
        return $this->GetReques($Param, $this->APPCODE, 'get_staff');
        
    }
}
?> 