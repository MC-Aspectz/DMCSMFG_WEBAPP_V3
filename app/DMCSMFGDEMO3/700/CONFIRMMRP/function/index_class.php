<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class ConfirmMRP extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'CONFIRMMRP';
    }

    public function getStaff($STAFFCD) {
        $Param = array( 'STAFFCD' => $STAFFCD);
        $cmd = GetRequestData($Param, 'plan.ConfirmMRP.getStaff', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getOffer($OFFERCODE, $COSTTYPES) {
        $Param = array( 'OFFERCODE' => $OFFERCODE,
                        'COSTTYPES' => $COSTTYPES);
        $cmd = GetRequestData($Param, 'plan.ConfirmMRP.getOffer', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function search($COSTTYPES, $DUEDATES, $OFFERCODE, $SD, $TD, $FACTORYCODE, $STAFFCD) {
        $Param = array( 'COSTTYPES' => $COSTTYPES,
                        'DUEDATES' => $DUEDATES,
                        'OFFERCODE' => $OFFERCODE,
                        'SD' => $SD,
                        'TD' => $TD,
                        'FACTORYCODE' => $FACTORYCODE,
                        'STAFFCD' => $STAFFCD,);
        $cmd = GetRequestData($Param, 'plan.ConfirmMRP.search', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function confirm($Param) {
        $cmd = GetRequestData($Param, 'plan.ConfirmMRP.confirm', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?>