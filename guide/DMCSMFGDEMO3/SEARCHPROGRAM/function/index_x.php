<?php
include_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
require_once($_SESSION['APPPATH'] . '/include/guideconfig.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');

$routeUrl = $_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php';
// print_r($routeUrl);
if (isset($_SESSION['LANG'])) {
    // require_once(dirname(__FILE__, 2). '/lang/jp.php');
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

$syslogic = new Syslogic;
$logicFunc = new SearchProgram;

$P1 = '';
$FORMTITLETYP_S = '';
$FORMPACKTYP_S = '';
$FORMNAME_S = '';
$LANG_S = '';
$tdata = array();
$minrow = 0;
$maxrow = 10; 

if(!empty($_POST)){

	$FORMTITLETYP_S = isset($_POST['FORMTITLETYP_S']) ? $_POST['FORMTITLETYP_S']:'';
    $FORMPACKTYP_S = isset($_POST['FORMPACKTYP_S']) ? $_POST['FORMPACKTYP_S']:'';
	$FORMNAME_S = isset($_POST['FORMNAME_S']) ? $_POST['FORMNAME_S']:'';
	$LANG_S = isset($_POST['LANG_S']) ? $_POST['LANG_S']:'';
    
    $excute = $logicFunc->getResult($FORMTITLETYP_S,$FORMPACKTYP_S,$FORMNAME_S,$LANG_S);
    if(!empty($excute)){

        $tdata =  $excute;
        // print_r($tdata);
    }
}

if(!empty($_GET)) {

    $LANG_S = isset($_GET['LANG_S']) ? $_GET['LANG_S']:'';
  
  }
  
$syspack = getDropdownData("APPPACK");
if(empty($syspack)) {
    $syspack = $syslogic->getPullDownData('APPPACK', $_SESSION['LANG']);
    setDropdownData("APPPACK", $syspack);
}

function getDropdownData($key = "") {
  return get_sys_data(SESSION_NAME_DROPDOWN, $key);
}

function setDropdownData($key, $val) {
  return set_sys_data(SESSION_NAME_DROPDOWN, $key, $val);
}
?>