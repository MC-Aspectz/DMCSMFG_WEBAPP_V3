<?php
require_once(dirname(__FILE__, 5) . '/common/syslogic.php');
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class AssetAccGuide extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ASSETACCGUIDE';
    }

    public function get_data() {
        $Param = array();
        return $this->GetRequesAll($Param, $this->APPCODE, 'get_data');
        
    }
}
?> 