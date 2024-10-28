<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class ProcessMaster extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'PROCESSMASTER';
    }

    //mas.ItemProcess.load
    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'mas.ItemProcess.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    //mas.ItemProcess.search ITEMCD,BMVERSION
    public function search($Param) {
        $cmd = GetRequestData($Param, 'mas.ItemProcess.search', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
    //mas.ItemProcess.getItem ITEMCD
    public function getItem($ITEMCD) {
        $Param = array( "ITEMCD" => $ITEMCD);
        $cmd = GetRequestData($Param, 'mas.ItemProcess.getItem', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    //mas.ItemProcess.getPlace ITEMSSPLACE (ITEMPSSPLACE,ITEMPSSTYP)
    public function getPlace($Param) {
        $cmd = GetRequestData($Param, 'mas.ItemProcess.getPlace', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    //mas.ItemProcess.getJobCode ITEMPSSJOBTYP (ITEMPSSJOBTYP)
    public function getJobCode($ITEMPSSJOBTYP) {
        $Param = array( "ITEMPSSJOBTYP" => $ITEMPSSJOBTYP);
        $cmd = GetRequestData($Param, 'mas.ItemProcess.getJobCode', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    //mas.ItemProcess.commitAll DVWDETAIL,BMVERSION,ITEMCD 
    public function commitAll($Param) {
        $cmd = GetRequestData($Param, 'mas.ItemProcess.commitAll', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    //mas.ItemProcess.searchClone ITEMCLONE
    public function searchClone($ITEMCLONE) {
        $Param = array( "ITEMCLONE" => $ITEMCLONE);
        $cmd = GetRequestData($Param, 'mas.ItemProcess.searchClone', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    //mas.ItemProcess.getSubQty IMPSSADDBOARDQTY,IMPSSADDSPM,IMPSSADDUSAGE,IMPSSADDOPE(ITEMPSSPLANQTY,ITEMPSSPLANTIMETYP,IMPSSADDBOARDQTY,IMPSSADDSPM,IMPSSADDUSAGE,IMPSSADDOPE)
    public function getSubQty($Param) {
        $cmd = GetRequestData($Param, 'mas.ItemProcess.getSubQty', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?>