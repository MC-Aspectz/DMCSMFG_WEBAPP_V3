<?php
require_once(dirname(__FILE__, 5) . '/common/syslogic.php');
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class SearchProgram extends Syslogic {
    
    public function __construct() {
        $this->APPCODE = 'SEARCHPROGRAM';
    }

    public function getResult($FORMTITLETYP_S,$FORMPACKTYP_S,$FORMNAME_S,$LANG_S) {
        $Param = array( "FORMTITLETYP_S" => $FORMTITLETYP_S,
                        "FORMPACKTYP_S" => $FORMPACKTYP_S,
                        "FORMNAME_S" => $FORMNAME_S,
                        "LANG_S" => $LANG_S,
                        "SQLSTATEMENT"=> "select DISTINCT  FormTitletyp,FormPackTyp,FormName from DSFORMVW where (FormName like '::FORMNAME_S:%') and (FormPackTyp like '::FORMPACKTYP_S:%')and (FormTitletyp like '::FORMTITLETYP_S:%')and (Lang like '::LANG_S:%')");
        $cmd = GetRequestData($Param, 'gen.GuideReport.getResult', 'SEARCHPROGRAM', '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 