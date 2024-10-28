<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class BuildCode {

    public function __construct() {
        $this->APPCODE = 'BUILDCODE';
    }

    public function build($param) {
        $cmd = GetRequestData($param, 'cost.ItemCost.build', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?> 