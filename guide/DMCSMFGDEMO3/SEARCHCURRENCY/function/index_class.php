<?php
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class ItemCurrency {

    public $P1 = '';

    public function __construct() {
        $this->APPCODE = 'SEARCHCURRENCY';
    }

    public function searchCurrency($P1) {
        $Param = array("P1" => $P1);
        $cmd = GetRequestData($Param, 'search.SearchGeneral.searchCurrency', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?> 
