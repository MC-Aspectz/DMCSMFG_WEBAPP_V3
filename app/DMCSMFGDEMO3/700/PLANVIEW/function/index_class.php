<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class PLANVIEW extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'PLANVIEW';
    }

    public function view($Param) {
        $cmd = GetRequestData($Param, 'plan.PlanView.view', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getItem($Param) {
        $cmd = GetRequestData($Param, 'plan.PlanView.getItem', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

}
?> 
