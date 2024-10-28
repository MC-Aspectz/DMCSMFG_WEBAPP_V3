<?php
//  Load Including Files

class javaFunction {
    
    public function chkLoadApp($APPCODE) {
        global $errorMessage;
        $Param = array( 'SYSCOMCD' => $_SESSION['COMCD'],
                        'COMPUTERNAME' => $_SESSION['COMPNAME'],
                        'SYSLOGINUSER' => $_SESSION['USERCODE'],
                        'FAPPCD' => $APPCODE);
        $cmd = GetRequestData($Param, 'gen.THA.Application.chkLoadApp', $APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function chkCloseApp($APPCODE) {
        global $errorMessage;
        $Param = array( 'SYSCOMCD' => $_SESSION['COMCD'],
                        'COMPUTERNAME' => $_SESSION['COMPNAME'],
                        'SYSLOGINUSER' => $_SESSION['USERCODE'],
                        'PFAPPCD' => $APPCODE);
        $cmd = GetRequestData($Param, 'gen.THA.Application.chkCloseApp', $APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function setLoadApp($APPCODE) {
        global $errorMessage;
        $Param = array( 'COMPUTERNAME' => $_SESSION['COMPNAME']);
        $cmd = GetRequestData($Param, 'gen.THA.Application.setLoadApp', $APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    
    public function getStaffConfig($STAFFCD) {
        global $errorMessage;
        $Param = array( 'STAFFCD' => $STAFFCD);
        $cmd = GetRequestData($Param, 'mas.THA.StaffMaster.getStaffConfig', 'STAFFMASTER', '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function savStaffConfig($Param) {
        global $errorMessage;
        $cmd = GetRequestData($Param, 'mas.THA.StaffMaster.savStaffConfig', 'STAFFMASTER', '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    
    public function ProgramRundelete($APPCODE) {
        global $errorMessage;
        $Param = array( 'STAFFCD' => $_SESSION['USERCODE'],
                        'COMPUTERNAME' => $_SESSION['COMPNAME'],
                        'STATUS' => 'END',
                        'PFAPPCD' => '');
        $cmd = GetRequestData($Param, 'gen.ProgramRun.delete', $APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getMessage($code) {
        global $errorMessage;
        $Param = array( 'CODEKEY_S' => 'MSG',
                        'CODE_S' => $code,
                        'LANG_S' => $_SESSION['LANG'],
                        'TEXT_S' => '');
        $cmd = GetRequestData($Param, 'gen.CodeMaster.searchCode', '', '');
        $data = Execute($cmd, $errorMessage);
        return isset($data['TEXT'])?$data['TEXT']:'';
    }
}
?>