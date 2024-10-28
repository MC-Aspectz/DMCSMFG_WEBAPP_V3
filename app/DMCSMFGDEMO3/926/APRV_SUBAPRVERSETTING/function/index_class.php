<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class ApprovalSubSetting extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'APRV_SUBAPRVERSETTING';
    }
}
?>