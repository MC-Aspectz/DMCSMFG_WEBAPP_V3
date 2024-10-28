<?php
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class SearchPropss {

    public $P1 = '';
    public $P2 = '';
    public $P3 = '';
    public $P4 = '';
    public $P5 = '';

    public function __construct() {
        $this->APPCODE = 'SEARCHPROPSS';
    }

    public function searchProOrder2($P1, $P2) {
        $Param = array('P1' => $P1, 'P2' => $P2);
        $cmd = GetRequestData($Param, 'search.SearchGeneral.searchProOrder2', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 
