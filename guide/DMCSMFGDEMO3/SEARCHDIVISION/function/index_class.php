<?php
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class DepartmentIndex {

    public $P1 = '';

    public function __construct() {
        $this->APPCODE = 'SEARCHDIVISION';
    }

    public function searchDepartment() {
        $Param = array('P1' => '');
        $cmd = GetRequestData($Param, 'search.SearchGeneral.searchDivision', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 
