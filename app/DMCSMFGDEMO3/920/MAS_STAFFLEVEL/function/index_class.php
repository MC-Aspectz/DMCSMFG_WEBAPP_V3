<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class MasStaffLevel extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'JOBRESULTVW';
    }

    // Syslogic(search_JR) I_DATE1,I_DATE2,I_WCCD
    public function search_JR($I_DATE1,$I_DATE2,$I_WCCD) {
        $Param = array("I_DATE1" => $I_DATE1, "I_DATE2" => $I_DATE2, "I_WCCD" => $I_WCCD);
        return $this->GetRequesAll($Param,  $this->APPCODE, 'search_JR');
    }

    //Syslogic(get_WC)
    public function get_WC($I_WCCD) {
        $Param = array('I_WCCD' => $I_WCCD);
        return $this->GetReques($Param,  $this->APPCODE, 'get_WC');
    }
}
?> 
