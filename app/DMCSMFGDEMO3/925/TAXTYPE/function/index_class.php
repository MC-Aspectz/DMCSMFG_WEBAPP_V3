<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class TaxType extends Syslogic {

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

//gen.TaxTypeEntry.ins  TAXTYPECD,TAXTYPENAME,TAXKBN,VATRATE,TAXTTL
    public function ins($Param) {
        $cmd = GetRequestData($Param, 'gen.TaxTypeEntry.ins', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

//gen.TaxTypeEntry.upd  TAXTYPECD,TAXTYPENAME,TAXKBN,VATRATE,TAXTTL
    public function upd($Param) {
        $cmd = GetRequestData($Param, 'gen.TaxTypeEntry.upd', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

//gen.TaxTypeEntry.del  TAXTYPECD
    public function del($Param) {
        $cmd = GetRequestData($Param, 'gen.TaxTypeEntry.del', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

//gen.TaxTypeEntry.get  TAXTYPECD
    public function get($TAXTYPECD) {
        $Param = array( "TAXTYPECD" => $TAXTYPECD);
        $cmd = GetRequestData($Param, 'gen.TaxTypeEntry.get', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

//gen.TaxTypeEntry.ratechk  VATRATE
    public function ratechk($VATRATE) {
        $Param = array( "VATRATE" => $VATRATE);
        $cmd = GetRequestData($Param, 'gen.TaxTypeEntry.ratechk', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }


}
?>