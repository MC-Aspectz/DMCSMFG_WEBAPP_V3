<?php
require_once(dirname(__FILE__, 5) . '/common/syslogic.php');
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class AssetGuide2 extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ASSETGUIDE02';
    }

    public function get_Assetguide($ASSETACC) {
        $Param = array('ASSETACC' => $ASSETACC);
        return $this->GetRequesAll($Param, $this->APPCODE, 'get_Assetguide');
        
    }

    public function get_assetacc($ASSETACC) {
        $Param = array('ASSETACC' => $ASSETACC);
        return $this->GetReques($Param, $this->APPCODE, 'get_assetacc');
        
    }
}
?> 