<?php
require_once(dirname(__FILE__, 5) . '/common/syslogic.php');
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class AssetGuide extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ASSETGUIDE';
    }

    public function get_Assetguide($ASSETACC, $VONO) {
        $Param = array('ASSETACC' => $ASSETACC, 'VONO' => $VONO);
        return $this->GetRequesAll($Param, $this->APPCODE, 'get_Assetguide');
        
    }

    public function get_assetacc($ASSETACC) {
        $Param = array('ASSETACC' => $ASSETACC);
        return $this->GetReques($Param, $this->APPCODE, 'get_assetacc');
        
    }
}
?> 