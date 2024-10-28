<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class CodeMaster extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'CodeMaster';
    }
//gen.CodeMaster.searchCode	CODEKEY_S,CODE_S,LANG_S,TEXT_S
    public function searchCode($CODEKEY_S,$CODE_S,$LANG_S,$TEXT_S) {
        $Param = array( "CODEKEY_S" => $CODEKEY_S,
                        "CODE_S" => $CODE_S,
                        "LANG_S" => $LANG_S,
                        "TEXT_S" => $TEXT_S,);
        $cmd = GetRequestData($Param, 'gen.CodeMaster.searchCode', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

//gen.CodeMaster.insCode	CODEID,CODEKEY,CODE,LANG,TEXT,CODEKEY_S,CODE_S,LANG_S,TEXT_S
    public function insCode($Param) {
        $cmd = GetRequestData($Param, 'gen.CodeMaster.insCode', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

//gen.CodeMaster.updCode	CODEID,CODEKEY,CODE,LANG,TEXT,CODEKEY_S,CODE_S,LANG_S,TEXT_S
    public function updCode($Param) {
        $cmd = GetRequestData($Param, 'gen.CodeMaster.updCode', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

//gen.CodeMaster.delCode	CODEID,CODEKEY,CODE,LANG,TEXT,CODEKEY_S,CODE_S,LANG_S,TEXT_S
    public function delCode($Param) {
        $cmd = GetRequestData($Param, 'gen.CodeMaster.delCode', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }




}
?>