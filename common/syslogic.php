<?php
// require_once(dirname(__FILE__, 1).'/SessionStart.php');
class Syslogic {

    protected function GetReques($Param, $APPCODE, $syslogic) {
        global $alert; global $errorMessage;
        $cmd = GetRequestData($Param, '', $APPCODE, $syslogic);
        $data = Execute($cmd, $errorMessage);
        if (strpos($errorMessage, 'ERRO:') !== false) {
            $code = str_replace('ERRO:', '', $errorMessage);
            if(strpos($code,' ') === false && substr($code, 0, 3) === 'ERR' && isset($_SESSION['LANG'])) {
                $errorMessage = $this->getMessage($code, $_SESSION['LANG']);
            }
            // $alert =  $this->setAlert($errorMessage);
            $data = $errorMessage;
        }
        return $data;
    }

    protected function GetRequesAll($Param, $APPCODE, $syslogic) {
        global $errorMessage;
        global $alert;
        $cmd = GetRequestData($Param, '', $APPCODE, $syslogic);
        $data = ExecuteAll($cmd, $errorMessage);
        if (!is_array($data) && strpos($data, 'ERRO:') !== false) {
            // $alert =  $this->setAlert($errorMessage);
            $data = $errorMessage;
        }
        return $data;
    }

    protected function GetRequesLargeAll($Param, $APPCODE, $syslogic) {
        global $errorMessage;
        global $alert;
        $cmd = GetRequestData($Param, '', $APPCODE, $syslogic);
        $data = ExecuteLargeAll($cmd, $errorMessage);
        if (!is_array($data) && strpos($data, 'ERRO:') !== false) {
            // $alert =  $this->setAlert($errorMessage);
            $data = $errorMessage;
        }
        return $data;
    }

    function getPullDownData($key, $lang) {
        $Param = array( 'CODEKEY_S' => $key,
                        'CODE_S' => '',
                        'LANG_S' => $lang,
                        'TEXT_S' => '');
        $cmd = GetRequestData($Param, 'gen.CodeMaster.searchCode', '', '');
        $data = Execute($cmd, $errorMessage);
        $res = array();
        foreach ($data as $item) {
            if($item['CODE'] != '' && $item['CODEKEY'] == $key) {
                $res[$item['CODE']] = $item['TEXT'];
            }
        }
        return $res;
    }

    public function getLoadStartApp() {
        global $errorMessage;
        $Param = array( 'COMPUTERNAME' => $_SESSION['COMPNAME']);
        $cmd = GetRequestData($Param, 'gen.GuideReport.loadGuide,gen.Application.getLoadApp,gen.Application.loadEvent', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function setPrivilege($APPCODE) {
        global $errorMessage;
        $Param = array( 'NOTParam' => '');
        $cmd = GetRequestData($Param, 'acc.THA.AccessibleControl.setPrivilege', $APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getLoadApp($APPCODE) {
        global $errorMessage;
        $Param = array( 'COMPUTERNAME' => $_SESSION['COMPNAME']);
        $cmd = GetRequestData($Param, 'gen.Application.getLoadApp', $APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function loadGuide($APPCODE) {
        global $errorMessage;
        $Param = array( 'COMPUTERNAME' => $_SESSION['COMPNAME']);
        $cmd = GetRequestData($Param, 'gen.GuideReport.loadGuide', $APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function loadEvent($APPCODE) {
        global $errorMessage;
        $Param = array( 'COMPUTERNAME' => $_SESSION['COMPNAME']);
        $cmd = GetRequestData($Param, 'gen.Application.loadEvent', $APPCODE, '');
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

    public function appExit($APPCODE) {
        global $errorMessage;
        $Param = array( 'COMPUTERNAME' => $_SESSION['COMPNAME']);
        $cmd = GetRequestData($Param, 'gen.ProgramRun.appExit', $APPCODE, '');
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
  
    public function setAlert($msg) {
        $msg = str_replace("\n","\\n",$msg);
        return "<script type='text/javascript'>alert(\"" . $msg . "\");</script>";
    }

    public function getMessage($code, $lang) {
        global $errorMessage;
        $Param = array( 'CODEKEY_S' => 'MSG',
                    'CODE_S' => $code,
                    'LANG_S' => $lang,
                    'TEXT_S' => '');
        $cmd = GetRequestData($Param, 'gen.CodeMaster.searchCode', '', '');
        $res = Execute($cmd, $errorMessage);
        return isset($res['TEXT'])?$res['TEXT']:'';
    }
}