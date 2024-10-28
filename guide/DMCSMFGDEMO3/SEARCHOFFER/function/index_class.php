<?php
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class OfferIndex {

    public $P1 = '';
    public $P2 = '';


    public function __construct() {
        $this->APPCODE = 'SEARCHOFFER';
    }

    // search.SearchGeneral.searchOffer P1,P2
    public function searchOffer($P1, $P2) {
        $Param = array("P1" => $P1, "P2" => $P2);
        $cmd = GetRequestData($Param, 'search.SearchGeneral.searchOffer', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 
