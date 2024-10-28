<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class ProductionPlan extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'PRODUCTIONPLAN';
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'plan.Schedule.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function search($COSTTYPES, $DUEDATES, $FACTORYCODE) {
        $Param = array( 'COSTTYPES' => $COSTTYPES,
                        'DUEDATES' => $DUEDATES,
                        'FACTORYCODE' => $FACTORYCODE,);
        $cmd = GetRequestData($Param, 'plan.ProPlanEntry.search', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function commitAll($Param) {
        $cmd = GetRequestData($Param, 'plan.ProPlanEntry.commitAll', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getItem($ITEMCODE) {
        $Param = array( 'ITEMCODE' => $ITEMCODE);
        $cmd = GetRequestData($Param, 'plan.ProPlanEntry.getItem', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getSW($SUPPLIERCODE, $COSTTYPE) {
        $Param = array( 'SUPPLIERCODE' => $SUPPLIERCODE,
                        'COSTTYPE' => $COSTTYPE);
        $cmd = GetRequestData($Param, 'plan.ProPlanEntry.getSW', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getLoc($LOCTYP, $LOCCD) {
        $Param = array( 'LOCTYP' => $LOCTYP,
                        'LOCCD' => $LOCCD);
        $cmd = GetRequestData($Param, 'plan.ProPlanEntry.getLoc', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?>