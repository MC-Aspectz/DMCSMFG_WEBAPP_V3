<?php
include_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
require_once($_SESSION['APPPATH'] . '/include/guideconfig.php');

$routeUrl = $_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php';
// print_r($routeUrl);
if (isset($_SESSION['LANG'])) {
    require_once(dirname(__FILE__, 2). '/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

$data = array();
$syslogic = new Syslogic;
$javaFunc = new SearchShipTrans;
$systemName = strtolower('SEARCHSHIPTRAN');
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 10;
$P1 = '';

//---------------------------GET-----------------------------------//
if(!empty($_GET)) {
    // print_r($_GET);
}

//---------------------------POST-----------------------------------//
if(!empty($_POST)) {
    if(isset($_POST['action']) && $_POST['action'] == 'unsetsession') { unsetSessionData(); }

    if(isset($_POST['SEARCH'])) {
      	$P1 = isset($_POST['P1']) ? $_POST['P1']: '';
    	$tdata = $javaFunc->searchShipTran($P1);
    	// echo '<pre>';
      	// print_r($tdata);
    	// echo '</pre>';
    }
}
// ------------------------- CALL Langauge  -------------------//
$loadApp = getSystemData('SEARCHSHIPTRAN');
if(empty($loadApp)) {
   	$loadApp = $syslogic->getLoadApp('SEARCHSHIPTRAN');
 	$syslogic->ProgramRundelete('SEARCHSHIPTRAN');
    setSystemData('SEARCHSHIPTRAN', $loadApp);
}
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//
function setSessionArray($arr){
    $keepField = array('TXTLANG', 'DRPLANG');
    foreach($arr as $k => $v){
        if(in_array($k, $keepField)) {
            setSessionData($k, $v);
        }
    }
}

function setSessionData($key, $val) {
    global $systemName;
    return set_sys_data($systemName, $key, $val);
}

function checkSessionData() {
    global $systemName;
    return check_sys_data($systemName);
}

function getSessionData($key = '') {
    global $systemName;
    return get_sys_data($systemName, $key);
}

function unsetSessionData($key = '') {
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    return unset_sys_data($key);
}

function getSystemData($key = '') {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}
?>