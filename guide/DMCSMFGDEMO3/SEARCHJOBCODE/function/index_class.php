<?php
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class JobCodeIndex {

    public function __construct() {
        $this->APPCODE = 'SEARCHJOBCODE';
    }

    public function searchJobCode($JOBNAME_S) {
        $Param = array( 'SQLSTATEMENT' => "select DISTINCT  JobCD,JobName from dsmbjobcodevw where (JobName like '::JOBNAME_S:%')",
                        'JOBNAME_S' => $JOBNAME_S);
        $cmd = GetRequestData($Param, 'gen.GuideReport.getResult', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 