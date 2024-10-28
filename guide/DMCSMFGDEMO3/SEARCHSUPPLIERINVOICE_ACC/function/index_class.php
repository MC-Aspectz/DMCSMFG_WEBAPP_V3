<?php
require_once(dirname(__FILE__, 5) . '/common/syslogic.php');
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class SearchSupplierInvoiceAcc extends Syslogic {

    public $P1 = '';
    public $P2 = '';
    public $P3 = '';
    public $P4 = '';
    public $P5 = '';

    public function __construct() {
        $this->APPCODE = 'SEARCHSUPPLIERINVOICE_ACC';
    }

    public function searchPurRecTran($Param) {

        return $this->GetRequesAll($Param, $this->APPCODE, 'searchPurRecTran');
        
    }
}
?>