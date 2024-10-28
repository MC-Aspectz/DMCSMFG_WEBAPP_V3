<?php
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class TaxCodeIndex {


    public function __construct() {
        $this->APPCODE = 'TaxType';
    }

//gen.TaxTypeEntry.search  TAXTYPESEARCH
    public function search($TAXTYPESEARCH) {
        $Param = array( "TAXTYPESEARCH" => $TAXTYPESEARCH);
        $cmd = GetRequestData($Param, 'gen.TaxTypeEntry.search', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?> 