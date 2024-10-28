<?php
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class WorkCenterIndex {

    public $P1 = '';

    public function __construct() {
        $this->APPCODE = 'SEARCHWORKCENTER';
    }

    public function searchWorkCenter() {
        $Param = array("WCCD_S" => '');
        $cmd = GetRequestData($Param, 'search.SearchGeneral.searchWC', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?> 
