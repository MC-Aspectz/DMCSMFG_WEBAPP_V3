<?php
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class StaffIndex {

    public $P1 = '';

    public function __construct() {
        $this->APPCODE = 'SEARCHSTAFF';
    }

    public function searchStaff($P1) {
        $Param = array('P1' => $P1);
        $cmd = GetRequestData($Param, 'search.SearchGeneral.searchStaff', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 
