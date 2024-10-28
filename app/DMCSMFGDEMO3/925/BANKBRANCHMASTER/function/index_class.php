<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class BranchMaster extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'BANKBRANCHMASTER';
    }

// mas.BranchMaster.getBank     BANKCD
    public function getBank($BANKCD) {
        $Param = array( "BANKCD" => $BANKCD);
        $cmd = GetRequestData($Param, 'mas.BranchMaster.getBank', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

// mas.BranchMaster.searchBranch    BANKCD
    public function searchBranch($BANKCD) {
        $Param = array( "BANKCD" => $BANKCD);
        $cmd = GetRequestData($Param, 'mas.BranchMaster.searchBranch', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

// mas.BranchMaster.insBranch   BANKCD,BRANCHCD,BRANCHNAME
    public function insBranch($Param) {
        $cmd = GetRequestData($Param, 'mas.BranchMaster.insBranch', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }


// mas.BranchMaster.updBranch   BANKCD,BRANCHCD,BRANCHNAME
    public function updBranch($Param) {
        $cmd = GetRequestData($Param, 'mas.BranchMaster.updBranch', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

// mas.BranchMaster.delBranch   BANKCD,BRANCHCD
    public function delBranch($Param) {
        $cmd = GetRequestData($Param, 'mas.BranchMaster.delBranch', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

// mas.BranchMaster.getBranch   BRANCHCD
    public function getBranch($BANKCD,$BRANCHCD) {
        $Param = array( "BANKCD" => $BANKCD,
                        "BRANCHCD" => $BRANCHCD,);
        $cmd = GetRequestData($Param, 'mas.BranchMaster.getBranch', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }



}
?>