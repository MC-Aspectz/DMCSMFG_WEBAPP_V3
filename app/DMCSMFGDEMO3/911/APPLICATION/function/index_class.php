<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class Application  {

    public function __construct() {
        $this->APPCODE = 'APPLICATION';
    }

   
    public function search($APPPACK_S) {
        $Param = array( "APPPACK_S" => $APPPACK_S);
        $cmd = GetRequestData($Param, 'gen.Application.search', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getAppName($FORMTITLETYP) {
        $Param = array( "FORMTITLETYP" => $FORMTITLETYP);
        $cmd = GetRequestData($Param, 'gen.Application.getAppName', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

  

    public function insApp($Param) {
        $cmd = GetRequestData($Param, 'gen.Application.insert', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    
    public function updApp($Param) {
        $cmd = GetRequestData($Param, 'gen.Application.update', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function delApp($Param) {
        $cmd = GetRequestData($Param, 'gen.Application.delete', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }


}
?>