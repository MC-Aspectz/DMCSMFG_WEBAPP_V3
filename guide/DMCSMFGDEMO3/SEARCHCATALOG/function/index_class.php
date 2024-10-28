<?php
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class ItemCategory {

    public $P1 = '';

    public function __construct() {
        $this->APPCODE = 'SEARCHCATALOG';
    }

    public function searchCategory($P1) {
        $Param = array("P1" => $P1);
        $cmd = GetRequestData($Param, 'search.SearchGeneral.searchCatalog', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 
