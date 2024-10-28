<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class WorkCenterMaster extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'WORKCENTERMASER';
    }

    //mas.WorkcenterMaster.load
    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'mas.WorkcenterMaster.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    //mas.WorkcenterMaster.search	WCCD_S,COMPRICETYPE
    public function search($WCCD_S,$COMPRICETYPE) {
        $Param = array( "WCCD_S" => $WCCD_S,
                        "COMPRICETYPE" => $COMPRICETYPE);
        $cmd = GetRequestData($Param, 'mas.WorkcenterMaster.search', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    //mas.WorkcenterMaster.insWc	WCCD_S,WCCD,WCNAME,DIVISIONCD,STAFFNAME,WCSTDHOURRATE,WCSTDCOST,WCHOURRATE,WCCOST,WCDISPLAYFLG,STAFFCD,WCTYP,COMPRICETYPE
    public function insWc($Param) {
        $cmd = GetRequestData($Param, 'mas.WorkcenterMaster.insWc', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    //mas.WorkcenterMaster.updWc	WCCD_S,WCCD,WCNAME,DIVISIONCD,STAFFNAME,WCSTDHOURRATE,WCSTDCOST,WCHOURRATE,WCCOST,WCDISPLAYFLG,STAFFCD,WCTYP,COMPRICETYPE
    public function updWc($Param) {
        $cmd = GetRequestData($Param, 'mas.WorkcenterMaster.updWc', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    
    //mas.WorkcenterMaster.delWc	WCCD_S,WCCD,COMPRICETYPE
    public function delWc($Param) {
        $cmd = GetRequestData($Param, 'mas.WorkcenterMaster.delWc', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    //mas.WorkcenterMaster.getWc	WCCD
    public function getWc($WCCD) {
        $Param = array( "WCCD" => $WCCD);
        $cmd = GetRequestData($Param, 'mas.WorkcenterMaster.getWc', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    //mas.DivisionMaster.getDiv	DIVISIONCD
    public function getDiv($DIVISIONCD) {
        $Param = array( "DIVISIONCD" => $DIVISIONCD);
        $cmd = GetRequestData($Param, 'mas.DivisionMaster.getDiv', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    //mas.StaffMaster.getStaff	STAFFCD
    public function getStaff($STAFFCD) {
        $Param = array( "STAFFCD" => $STAFFCD);
        $cmd = GetRequestData($Param, 'mas.StaffMaster.getStaff', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

}
?>