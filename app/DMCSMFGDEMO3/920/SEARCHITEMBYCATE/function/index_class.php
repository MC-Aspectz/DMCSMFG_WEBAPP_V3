<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class SearchItemByCate extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'SEARCHITEMBYCATE';
    }

    public function getCat($CATALOGCD) {
        $Param = array( "CATALOGCD" => $CATALOGCD);
        $cmd = GetRequestData($Param, 'mas.ItemMaster.getCat', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getItembyCategory($FM0931CATESTART, $FM0931CATEEND) {
        $Param = array( "FM0931CATESTART" => $FM0931CATESTART,
                        "FM0931CATEEND" => $FM0931CATEEND);
        return $this->GetReques($Param, $this->APPCODE, 'getItembyCategory');
    }
}
?>