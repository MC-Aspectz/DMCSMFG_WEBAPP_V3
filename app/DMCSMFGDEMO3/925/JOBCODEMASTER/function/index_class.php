<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class JobCodeMaster extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'JOBCODEMASTER';
    }
    
//gen.JobCode.search JOBCDS,JOBTYPES
    public function search($JOBCDS,$JOBTYPES) {
        $Param = array( "JOBCDS" => $JOBCDS,"JOBTYPES"=>$JOBTYPES);
        $cmd = GetRequestData($Param, 'gen.JobCode.search', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
//gen.JobCode.commit 
    public function commit($Param) {
        $cmd = GetRequestData($Param, 'gen.JobCode.commit', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    
}
?>