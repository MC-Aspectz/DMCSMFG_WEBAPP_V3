<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccRPTAssetDeplist extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_RPTASSETDEPLIST';
    }

    public function getAssetGName($GA1) {
    	$Param = array( 'GA1' => $GA1);
        return $this->GetReques($Param,  $this->APPCODE, 'getAssetGName');
    }

    public function getData($YEAR, $GA1) {
    	$Param = array( 'YEAR' => $YEAR, 'GA1' => $GA1);
        return $this->GetRequesAll($Param,  $this->APPCODE, 'getData');
    }
}
?>