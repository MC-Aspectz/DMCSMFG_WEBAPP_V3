<?php
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class ScrapView {

    public function __construct() {
        $this->APPCODE = 'SCRAPVIEW';
    }

    public function getOrder($PROORDERNO) {
        $Param = array('PROORDERNO' => $PROORDERNO);
        $cmd = GetRequestData($Param, 'pro.ScrapView.getOrder', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
// PROORDERNO,ROUTNO,BADQTY,CMAMOUNTTYPE,CMPRICETYPE,COMAMOUNTTYPE,COMPRICETYPE
    public function searchPro($Param) {
        $cmd = GetRequestData($Param, 'pro.ScrapView.searchPro', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function scrapReason($Param) {
        $cmd = GetRequestData($Param, 'pro.ScrapView.scrapReason', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function searchPrice($Param) {
        $cmd = GetRequestData($Param, 'pro.ScrapView.searchPrice', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 
